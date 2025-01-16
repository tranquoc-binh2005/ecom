<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post)
    {
        return (
            $post->status == Post::STATUS_PUBLISHED ||
            ($user && (
                    $user->id == $post->user_id
                    || $user->hasPermission('review_post')
                ))
        )
            ? Response::allow()
            : Response::deny('Bạn không có quyền xem bài viết này.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Post $post)
    {
        return ($user->id == $post->user_id || $user->hasPermission('create_post'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền tạo bài viết.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post)
    {
        return ($user->id == $post->user_id || $user->hasPermission('update_post'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền sửa bài viết này.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        return ($user->id == $post->user_id || $user->hasPermission('delete_post'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền xóa bài viết này.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post)
    {
        return ($user->id == $post->user_id || $user->hasPermission('restore_post'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền khôi phục bài viết này.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post)
    {
        return ($user->id == $post->user_id || $user->hasPermission('force_delete_post'))
            ? Response::allow()
            : Response::deny('Bạn không có quyền xóa vĩnh viễn bài viết này.');
    }
}
