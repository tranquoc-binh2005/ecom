<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Attribute;
use App\Models\PostCatalogue;
use App\Services\AttributeService;
use App\Services\AttributeValueService;
use App\ViewModels\backend\PostCatalogueViewModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\PostCatalogueService;

class AttributeController extends Controller
{
    private AttributeValueService $attributeValueService;
    private AttributeService $attributeService;
    public function __construct(
        AttributeValueService  $attributeValueService,
        AttributeService  $attributeService
    )
    {
        $this->attributeValueService  = $attributeValueService;
        $this->attributeService  = $attributeService;
    }

    public function index(Request $request)
    {
        $title = __('dashboard.postCatalogue');
        $breadcrumb = [
            'route' => 'post.catalogue.index',
            'title' => __('dashboard.postCatalogue'),
        ];

        $attributes = $this->attributeService->paginate($request);
        $attributeValues = $this->attributeValueService->paginate($request);
        return view('backend.attribute.index', compact('title', 'breadcrumb', 'attributes', 'attributeValues'));
    }

    public function create(Request $request)
    {
        $title = __('postCatalogue_message.add');
        $breadcrumb = [
            'route' => 'post.catalogue.create',
            'title' => __('postCatalogue_message.add'),
        ];
        $attributes = $this->attributeService->paginate($request);
        return view('backend.attribute.store', compact('title','breadcrumb', 'attributes'));
    }

    public function store(StoreAttributeRequest $request)
    {
        if($this->attributeService->create($request->all())){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.add_success'));
        }
        return back()->with('error', __('postCatalogue_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id)
    {
        $title = __('postCatalogue_message.edit');
        $breadcrumb = [
            'route' => 'post.catalogue.create',
            'title' => __('postCatalogue_message.edit'),
        ];
        $attribute = $this->attributeService->find($id);
        $attributes = $this->attributeService->paginate($request);
        return view('backend.attribute.store', compact('title','breadcrumb','attribute', 'attributes'));
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        if($this->attributeService->update($id, $request->all())){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.edit_success'));
        }
        return back()->with('error', __('postCatalogue_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('postCatalogue_message.delete');
        $breadcrumb = [
            'route' => 'post.catalogue.delete',
            'title' => __('postCatalogue_message.delete'),
        ];
        $postCatalogue = $this->attributeService->find($id);
        return view('backend.attribute.destroy', compact('title','breadcrumb', 'postCatalogue'));
    }

    public function destroy($id)
    {
        if($this->attributeService->delete($id)){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.delete_success'));
        }
        return back()->with('error', __('postCatalogue_message.delete_error'))->withInput();
    }
}
