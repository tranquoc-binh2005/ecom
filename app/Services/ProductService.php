<?php
namespace App\Services;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantAttributeRepository;
use App\Services\Interface\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService implements ProductServiceInterface
{
    private ProductRepository $productRepository;
    public function __construct(
        ProductRepository $productRepository,
        ProductVariantAttributeRepository $productVariantAttributeRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productVariantAttributeRepository = $productVariantAttributeRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish') ?? 1;
        $condition['product_catalogue_id'] = intval($request->input('product_catalogue_id'));
        $perPage = $request->input('perpage', 10);
        return $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'product'],
            ['order', 'DESC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->productRepository->findById($id);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->create($this->filterPayload($request));
            $this->createPivot($product, $request);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    private function createPivot($product, $request): void
    {
        $payload = [
            'attribute' => $request['attribute'] ?? "",
            'variant' => $request['variant'] ?? "",
            'attribute_value' => $request['attribute_value'] ?? "",
        ];
        $variant = $this->createVariantArray($payload);
        $product->product_variant()->delete();
        $variant = $product->product_variant()->createMany($variant);
        $variantId = $variant->pluck('id')->toArray();
        $variantAttribute = [];
        if(count($variantId)){
            foreach ($variantId as $value) {
                if(count($payload['attribute_value'])){
                    foreach ($payload['attribute_value'] as $valAttr) {
                        if(count($valAttr)){
                            foreach ($valAttr as $attr) {
                                $variantAttribute[] = [
                                    'product_variant_id' => $value,
                                    'attribute_value_id' => $attr,
                                ];
                            }
                        }
                    }
                }
            }
        }
        $this->productVariantAttributeRepository->createBatch($variantAttribute);
    }

    private function createVariantArray(array $payload = []): array
    {
        $variant = [];
        if(isset($payload['variant']['sku']) && count($payload['variant']['sku'])) {
            foreach ($payload['variant']['sku'] as $key => $val) {
                $variant[] = [
                    'quantity' => ($payload['variant']['quantity'][$key]) ? intval($payload['variant']['quantity'][$key]) : '',
                    'price' => ($payload['variant']['price'][$key]) ?? '',
                    'barcode' => ($payload['variant']['barcode'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                    'sku' => $val,
                    'code' => ($payload['attribute']['id'][$key]) ?? '',
                    'user_id' => Auth::id(),
                ];
            }
        }
        return $variant;
    }

    public function update($id, array $payload)
    {
        DB::beginTransaction();
        try {
            $user = $this->productRepository->update($id, $this->filterPayload($payload));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->productRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    private function filterPayload(array $payload): array
    {
        $payload['user_id'] = Auth::id();
        $payload['slug'] = Str::slug($payload['slug']);
        if (isset($payload['album']) &&is_array($payload['album'])) {
            $payload['album'] = implode(',', $payload['album']);
        }
        $payload['description'] = preg_replace('/^<p>(.*?)<\/p>$/s', '$1', $payload['description']);
        $payload['content'] = preg_replace('/^<p>(.*?)<\/p>$/s', '$1', $payload['content']);
        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
