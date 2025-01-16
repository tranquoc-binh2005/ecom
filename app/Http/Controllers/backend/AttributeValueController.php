<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Services\AttributeService;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
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
            'route' => 'attribute.value.index',
            'title' => __('dashboard.postCatalogue'),
        ];

        $attributes = $this->attributeValueService->paginate($request);
        return view('backend.attributeValue.index', compact('title', 'breadcrumb', 'attributes'));
    }

    public function create(Request $request)
    {
        $title = __('postCatalogue_message.add');
        $breadcrumb = [
            'route' => 'attribute.value.create',
            'title' => __('postCatalogue_message.add'),
        ];
        $attributes = $this->attributeService->paginate($request);
        return view('backend.attributeValue.store', compact('title','breadcrumb', 'attributes'));
    }

    public function store(StoreAttributeValueRequest $request)
    {
        if($this->attributeValueService->create($request->all())){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.add_success'));
        }
        return back()->with('error', __('postCatalogue_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id)
    {
        $title = __('postCatalogue_message.edit');
        $breadcrumb = [
            'route' => 'attribute.value.create',
            'title' => __('postCatalogue_message.edit'),
        ];
        $attrValue = $this->attributeValueService->find($id);
        $attributes = $this->attributeService->paginate($request);
        return view('backend.attributeValue.store', compact('title','breadcrumb','attrValue', 'attributes'));
    }

    public function update(UpdateAttributeValueRequest $request, $id)
    {
        if($this->attributeValueService->update($id, $request->all())){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.edit_success'));
        }
        return back()->with('error', __('postCatalogue_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('postCatalogue_message.delete');
        $breadcrumb = [
            'route' => 'attribute.value.delete',
            'title' => __('postCatalogue_message.delete'),
        ];
        $attrValue = $this->attributeValueService->find($id);
        return view('backend.attributeValue.destroy', compact('title','breadcrumb', 'attrValue'));
    }

    public function destroy($id)
    {
        if($this->attributeValueService->delete($id)){
            return redirect()->route('attribute.index')->with('success', __('postCatalogue_message.delete_success'));
        }
        return back()->with('error', __('postCatalogue_message.delete_error'))->withInput();
    }
}
