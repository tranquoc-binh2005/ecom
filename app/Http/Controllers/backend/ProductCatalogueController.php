<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCatalogue;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Services\ProductCatalogueService;
use App\ViewModels\backend\ProductCatalogueViewModel;
use Illuminate\Http\Request;

class ProductCatalogueController extends Controller
{
    private ProductCatalogueService $productCatalogueService;
    private ProductCatalogueViewModel $productCatalogueViewModel;
    public function __construct(ProductCatalogueService  $productCatalogueService)
    {
        $this->productCatalogueService  = $productCatalogueService;
    }

    public function index(Request $request)
    {
        $title = __('dashboard.productCatalogue');
        $breadcrumb = [
            'route' => 'product.catalogue.index',
            'title' => __('dashboard.postCatalogue'),
        ];

        $postCatalogues = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($postCatalogues);
        return view('backend.productCatalogue.index', compact('title', 'breadcrumb', 'viewModel'));
    }

    public function create(Request $request)
    {
        $title = __('productCatalogue_message.add');
        $breadcrumb = [
            'route' => 'product.catalogue.create',
            'title' => __('productCatalogue_message.add'),
        ];
        $request['perpage'] = 100;
        $postCatalogues = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($postCatalogues);
        return view('backend.productCatalogue.store', compact('title','breadcrumb', 'viewModel'));
    }

    public function store(StoreProductCatalogue $request)
    {
        if($this->productCatalogueService->create($request->all())){
            return redirect()->route('product.catalogue.index')->with('success', __('productCatalogue_message.add_success'));
        }
        return back()->with('error', __('productCatalogue_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id)
    {
        $title = __('productCatalogue_message.edit');
        $breadcrumb = [
            'route' => 'product.catalogue.create',
            'title' => __('productCatalogue_message.edit'),
        ];
        $postCatalogue = $this->productCatalogueService->find($id);
        $postCatalogues = $this->productCatalogueService->paginate($request);
        $viewModel = new ProductCatalogueViewModel($postCatalogues);
        return view('backend.productCatalogue.store', compact('title','breadcrumb','postCatalogue', 'viewModel'));
    }

    public function update(UpdatePostCatalogueRequest $request, $id)
    {
        if($this->productCatalogueService->update($id, $request->all())){
            return redirect()->route('product.catalogue.index')->with('success', __('productCatalogue_message.edit_success'));
        }
        return back()->with('error', __('productCatalogue_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('productCatalogue_message.delete');
        $breadcrumb = [
            'route' => 'product.catalogue.delete',
            'title' => __('productCatalogue_message.delete'),
        ];
        $postCatalogue = $this->productCatalogueService->find($id);
        return view('backend.productCatalogue.destroy', compact('title','breadcrumb', 'postCatalogue'));
    }

    public function destroy($id)
    {
        if($this->productCatalogueService->delete($id)){
            return redirect()->route('product.catalogue.index')->with('success', __('productCatalogue_message.delete_success'));
        }
        return back()->with('error', __('productCatalogue_message.delete_error'))->withInput();
    }
}
