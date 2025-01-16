<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Permission $Permission)
    {
        return (
            $Permission->status == Permission::STATUS_PUBLISHED ||
            ($user && (
                    $user->id == $Permission->user_id
                    || $user->hasPermission('review_permission')
                ))
        )
            ? Response::allow()
            : Response::deny('Bạn không có quyền xem bài viết này.');
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user)
    {
        return  ($user->id && $user->hasPermission('create_permission'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền thêm mới quyền trong hệ thống');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $Permission)
    {
        return ($user->id == $Permission->user_id || $user->hasPermission('update_permission'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền sửa bài viết này.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $Permission)
    {
        return ($user->id == $Permission->user_id || $user->hasPermission('delete_permission'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền xóa bài viết này.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $Permission)
    {
        return ($user->id == $Permission->user_id || $user->hasPermission('restore_permission'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền khôi phục bài viết này.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $Permission)
    {
        return ($user->id == $Permission->user_id || $user->hasPermission('force_delete_permission'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền xóa vĩnh viễn bài viết này.');
    }
}
