<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use App\ViewModels\backend\PostCatalogueViewModel;
use App\ViewModels\backend\PostViewModel;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostCatalogueService;


class PostController extends Controller
{
    private PostService $postService;
    private PostCatalogueService $postCatalogueService;
    public function __construct(
        PostService  $postService,
        PostCatalogueService $postCatalogueService
    )
    {
        $this->postService  = $postService;
        $this->postCatalogueService  = $postCatalogueService;
        //$this->middleware('can:view,post')->only('show');
    }

    public function index(Request $request, Post $post)
    {
        $this->authorize('view', $post);
        $title = __('dashboard.postCatalogue');
        $breadcrumb = [
            'route' => 'post.index',
            'title' => __('dashboard.postCatalogue'),
        ];

        $posts = $this->postService->paginate($request);

        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);

        return view('backend.post.index', compact('title', 'breadcrumb', 'posts', 'viewModel'));
    }

    public function create(Request $request, Post $post)
    {
        $this->authorize('create', $post);
        $title = __('post_message.add');
        $breadcrumb = [
            'route' => 'post.create',
            'title' => __('post_message.add'),
        ];
        $request['perpage'] = 100;
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);
        return view('backend.post.store', compact('title','breadcrumb', 'viewModel'));
    }

    public function store(StorePostRequest $request, Post $post)
    {
        $this->authorize('create', $post);
        if($this->postService->create($request->all())){
            return redirect()->route('post.index')->with('success', __('post_message.add_success'));
        }
        return back()->with('error', __('post_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id, Post $post)
    {
        $this->authorize('update', $post);
        $title = __('post_message.update');
        $breadcrumb = [
            'route' => 'post.create',
            'title' => __('post_message.update'),
        ];
        $post = $this->postService->find($id);

        $postCatalogues = $this->postCatalogueService->paginate($request);
        $viewModel = new PostCatalogueViewModel($postCatalogues);

        return view('backend.post.store', compact('title','breadcrumb','viewModel', 'post'));
    }

    public function update(UpdatePostRequest $request, $id, Post $post)
    {
        $this->authorize('update', $post);
        if($this->postService->update($id, $request->all())){
            return redirect()->route('post.index')->with('success', __('post_message.update_success'));
        }
        return back()->with('error', __('post_message.update_error'))->withInput();
    }

    public function delete($id, Post $post)
    {
        $this->authorize('delete', $post);
        $title = __('post_message.delete');
        $breadcrumb = [
            'route' => 'post.delete',
            'title' => __('post_message.delete'),
        ];
        $post = $this->postService->find($id);
        return view('backend.post.destroy', compact('title','breadcrumb', 'post'));
    }

    public function destroy($id, Post $post)
    {
        $this->authorize('delete', $post);
        if($this->postService->delete($id)){
            return redirect()->route('post.index')->with('success', __('post_message.delete_success'));
        }
        return back()->with('error', __('post_message.delete_error'))->withInput();
    }
}
