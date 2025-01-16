<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    private PermissionService $permissionService;
    private RoleService $roleService;
    public function __construct(
        PermissionService $permissionService,
        RoleService $roleService
    )
    {
        $this->permissionService  = $permissionService;
        $this->roleService  = $roleService;
        $this->middleware('can:view,permission')->only('show');
    }

    public function index(Request $request, Permission $permission)
    {
        $this->authorize('view', $permission);
        $title = __('permission_message.add');
        $breadcrumb = [
            'route' => 'permission.index',
            'title' => __('permission_message.add'),
        ];

        $permissions = $this->permissionService->paginate($request);
        $roles = $this->roleService->paginate($request);

        return view('backend.permission.index', compact('title', 'breadcrumb', 'permissions', 'roles'));
    }

    public function changePermission(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);
        $permissions = $request->input('permission');

        if(!$permissions){
            return response()->json(['status' => 'error', 'message' => 'oke'], 404);
        }
        foreach ($permissions as $index => $permission) {
            $roles = $this->roleService->find($index);

            $roles->permissions()->sync($permission);
        }

        return redirect()->route('permission.index')->with('success', __('permission_message.edit_success'));
    }

    public function create(Request $request, Permission $permission)
    {
        $this->authorize('create', $permission);
        $title = __('permission_message.add');
        $breadcrumb = [
            'route' => 'permission.create',
            'title' => __('permission_message.add'),
        ];

        return view('backend.permission.store', compact('title','breadcrumb'));
    }

    public function store(StorePermissionRequest $request, Permission $permission)
    {
        $this->authorize('create', $permission);
        if($this->permissionService->create($request->all())){
            return redirect()->route('permission.index')->with('success', __('permission_message.add_success'));
        }
        return back()->with('error', __('permission_message.add_error'))->withInput();
    }

    public function edit(Request $request, $id, Permission $permission)
    {
        $this->authorize('update', $permission);
        $title = __('permission_message.update');
        $breadcrumb = [
            'route' => 'permission.create',
            'title' => __('permission_message.update'),
        ];
        $permission = $this->permissionService->find($id);

        return view('backend.permission.store', compact('title','breadcrumb','permission'));
    }

    public function update(UpdatePermissionRequest $request, $id, Permission $permission)
    {
        $this->authorize('update', $permission);
        if($this->permissionService->update($id, $request->all())){
            return redirect()->route('permission.index')->with('success', __('permission_message.edit_success'));
        }
        return back()->with('error', __('permission_message.edit_error'))->withInput();
    }

    public function delete($id, Permission $permission)
    {
        $this->authorize('delete', $permission);
        $title = __('permission_message.delete');
        $breadcrumb = [
            'route' => 'permission.delete',
            'title' => __('permission_message.delete'),
        ];
        $permission = $this->permissionService->find($id);
        return view('backend.permission.destroy', compact('title','breadcrumb', 'permission'));
    }

    public function destroy($id)
    {
        if($this->permissionService->delete($id)){
            return redirect()->route('permission.index')->with('success', __('permission_message.delete_success'));
        }
        return back()->with('error', __('permission_message.delete_error'))->withInput();
    }
}
