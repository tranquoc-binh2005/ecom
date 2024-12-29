<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    private RoleService $roleService;
    public function __construct(RoleService  $roleService)
    {
        $this->roleService  = $roleService;
    }

    public function index(Request $request)
    {
        $title = __('dashboard.role');
        $breadcrumb = [
            'route' => 'role.index',
            'title' => __('dashboard.role'),
        ];
        $roles = $this->roleService->paginate($request);
        return view('backend.role.index', compact('title','roles', 'breadcrumb'));
    }

    public function create(){
        $title = __('role_message.add');
        $breadcrumb = [
            'route' => 'role.create',
            'title' => __('role_message.add'),
        ];
        return view('backend.role.store', compact('title','breadcrumb'));
    }

    public function store(StoreRoleRequest $request)
    {
        if($this->roleService->create($request->only('name','slug','description'))){
            return redirect()->route('role.index')->with('success', __('role_message.add_success'));
        }
        return back()->with('error', __('role_message.add_error'))->withInput();
    }

    public function edit($id)
    {
        $title = __('role_message.edit');
        $breadcrumb = [
            'route' => 'role.create',
            'title' => __('role_message.edit'),
        ];
        $role = $this->roleService->find($id);
        return view('backend.role.store', compact('title','breadcrumb','role'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $data = $request->only('name','slug','description');
        if($this->roleService->update($id, $data)){
            return redirect()->route('role.index')->with('success', __('role_message.edit_success'));
        }
        return back()->with('error', __('role_message.edit_error'))->withInput();
    }

    public function delete($id)
    {
        $title = __('role_message.delete');
        $breadcrumb = [
            'route' => 'role.delete',
            'title' => __('role_message.delete'),
        ];
        $role = $this->roleService->find($id);
        return view('backend.role.destroy', compact('title','breadcrumb', 'role'));
    }

    public function destroy($id)
    {
        if($this->roleService->delete($id)){
            return redirect()->route('role.index')->with('success', __('role_message.delete_success'));
        }
        return back()->with('error', __('role_message.delete_error'))->withInput();
    }
}
