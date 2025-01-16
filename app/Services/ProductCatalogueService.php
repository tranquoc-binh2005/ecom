<?php
namespace App\Services;
use App\Models\PostCatalogue;
use App\Repositories\ProductCatalogueRepository;
use App\Services\Interface\ProductCatalogueServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCatalogueService implements ProductCatalogueServiceInterface
{
    private ProductCatalogueRepository $productCatalogueRepository;
    public function __construct(ProductCatalogueRepository $productCatalogueRepository)
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publish') ?? 1;
        $perPage = $request->input('perpage', 10);
        return $this->productCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'product/catalogue'],
            ['_lft', 'ASC'],
        );
    }

    public function find($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->productCatalogueRepository->findById($id);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function create($payload)
    {
        DB::beginTransaction();
        try {
            $this->productCatalogueRepository->create($this->filterPayload($payload));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function update($id, array $payload)
    {
        DB::beginTransaction();
        try {
            $user = $this->productCatalogueRepository->update($id, $this->filterPayload($payload));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->productCatalogueRepository->delete($id);
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
        return $payload;
    }

    private function paginateSelect(): array
    {
        return [
            '*'
        ];
    }
}
