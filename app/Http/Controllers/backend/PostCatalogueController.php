<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\PostCatalogue;
use App\ViewModels\backend\PostCatalogueViewModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\PostCatalogueService;

class PostCatalogueController extends Controller
{
    private PostCatalogueService $postCatalogueService;
    private PostCatalogueViewModel $postCatalogueView;
    public function __construct(PostCatalogueService  $postCatalogueService)
    {
        $this->postCatalogueService  = $postCatalogueService;
    }

    public function index(Request $request)
    {
        $title = __('dashboard.postCatalogue');
        $breadcrumb = [
            'route' => 'post.catalogue.index',
            'title' => __('dashboard.postCatalogue'),
        ];

        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);
        return view('backend.postCatalogue.index', compact('title', 'breadcrumb', 'viewModel'));
    }

    public function create(Request $request)
    {
        $title = __('postCatalogue_message.add');
        $breadcrumb = [
            'route' => 'post.catalogue.create',
            'title' => __('postCatalogue_message.add'),
        ];
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);
        return view('backend.postCatalogue.store', compact('title','breadcrumb', 'viewModel'));
    }

    public function store(StorePostCatalogueRequest $request)
    {
        if($this->postCatalogueService->create($request->all())){
            return redirect()->route('post.catalogue.index')->with('success', __('postCatalogue_message.add_success'));
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
        $postCatalogue = $this->postCatalogueService->find($id);
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);
        return view('backend.postCatalogue.store', compact('title','breadcrumb','postCatalogue', 'viewModel'));
    }

    public function update(UpdatePostCatalogueRequest $request, $id)
    {
        if($this->postCatalogueService->update($id, $request->all())){
            return redirect()->route('post.catalogue.index')->with('success', __('postCatalogue_message.edit_success'));
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
        $postCatalogue = $this->postCatalogueService->find($id);
        return view('backend.postCatalogue.destroy', compact('title','breadcrumb', 'postCatalogue'));
    }

    public function destroy($id)
    {
        if($this->postCatalogueService->delete($id)){
            return redirect()->route('post.catalogue.index')->with('success', __('postCatalogue_message.delete_success'));
        }
        return back()->with('error', __('postCatalogue_message.delete_error'))->withInput();
    }
}
