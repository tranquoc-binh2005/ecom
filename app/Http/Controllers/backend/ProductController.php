<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\AttributeService;
use App\Services\AttributeValueService;
use App\Services\ProductCatalogueService;
use App\Services\ProductService;
use App\ViewModels\backend\ProductCatalogueViewModel;
use App\ViewModels\backend\ProductViewModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;
    private ProductCatalogueService $productCatalogueService;
    private AttributeService $attributeService;
    private AttributeValueService $attributeValueService;
    private ProductViewModel $productViewModel;
    public function __construct(
        ProductService  $productService,
        ProductCatalogueService $productCatalogueService,
        AttributeService $attributeService,
        AttributeValueService $attributeValueService,
    )
    {
        $this->productService  = $productService;
        $this->productCatalogueService = $productCatalogueService;
        $this->attributeService = $attributeService;
        $this->attributeValueService = $attributeValueService;
    }

    public function index(Request $request)
    {
        $title = __('Danh sách sản phẩm');
        $breadcrumb = [
            'route' => 'product.index',
            'title' => __('Trang sản phẩm'),
        ];

        $products = $this->productService->paginate($request);

        $categories = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($categories);
        return view('backend.product.index', compact('title', 'breadcrumb', 'products', 'viewModel'));
    }

    public function create(Request $request)
    {
        $title = __('Thêm sản phẩm');
        $breadcrumb = [
            'route' => 'product.create',
            'title' => __('Thêm sản phẩm'),
        ];
        $request['perpage'] = 100;
        $categories = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($categories);

        $attributes = $this->attributeService->paginate($request);
        return view('backend.product.store', compact('title','breadcrumb', 'viewModel', 'attributes'));
    }

    public function store(StoreProductRequest $request)
    {
        if($this->productService->create($request->all())){
            return redirect()->route('product.index')->with('success', __('product_message.add_success'));
        }
        return back()->with('error', __('product_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id)
    {
        $title = __('product_message.edit');
        $breadcrumb = [
            'route' => 'product.create',
            'title' => __('product_message.edit'),
        ];
        $product = $this->productService->find($id);
        dd($product);
        $categories = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($categories);
        return view('backend.product.store', compact('title','breadcrumb','product', 'viewModel'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        if($this->productService->update($id, $request->all())){
            return redirect()->route('product..index')->with('success', __('product_message.edit_success'));
        }
        return back()->with('error', __('product_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('product_message.delete');
        $breadcrumb = [
            'route' => 'product.delete',
            'title' => __('product_message.delete'),
        ];
        $product = $this->productService->find($id);
        return view('backend.product.destroy', compact('title','breadcrumb', 'product'));
    }

    public function destroy($id)
    {
        if($this->productService->delete($id)){
            return redirect()->route('product.index')->with('success', __('product_message.delete_success'));
        }
        return back()->with('error', __('product_message.delete_error'))->withInput();
    }
}
