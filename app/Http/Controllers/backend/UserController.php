<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(
        UserService  $userService,
        RoleService $roleService
    )
    {
        $this->userService  = $userService;
        $this->roleService  = $roleService;
    }

    public function index(Request $request)
    {
        $title = __('dashboard.user');
        $breadcrumb = [
            'route' => 'user',
            'title' => __('dashboard.role'),
        ];
        $users = $this->userService->paginate($request);
        return view('backend.user.index', compact('title','users', 'breadcrumb'));
    }

    public function create(Request $request){
        $title = __('user_message.add');
        $breadcrumb = [
            'route' => 'user.create',
            'title' => __('user_message.add'),
        ];
        $roles = $this->roleService->paginate($request);
        return view('backend.user.store', compact('title','breadcrumb', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        if($this->userService->create($request->all())){
            return redirect()->route('user.index')->with('success', __('user_message.add_success'));
        }
        return back()->with('error', __('user_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id)
    {
        $title = __('user_message.edit');
        $breadcrumb = [
            'route' => 'user.create',
            'title' => __('user_message.edit'),
        ];
        $roles = $this->roleService->paginate($request);
        $user = $this->userService->find($id);
        return view('backend.user.store', compact('title','breadcrumb','user','roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if($this->userService->update($id, $request->all())){
            return redirect()->route('user.index')->with('success', __('user_message.edit_success'));
        }
        return back()->with('error', __('user_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('user_message.delete');
        $breadcrumb = [
            'route' => 'user.delete',
            'title' => __('user_message.delete'),
        ];
        $user = $this->userService->find($id);
        return view('backend.user.destroy', compact('title','breadcrumb', 'user'));
    }

    public function destroy($id)
    {
        if($this->userService->delete($id)){
            return redirect()->route('user.index')->with('success', __('user_message.delete_success'));
        }
        return back()->with('error', __('user_message.delete_error'))->withInput();
    }
}
