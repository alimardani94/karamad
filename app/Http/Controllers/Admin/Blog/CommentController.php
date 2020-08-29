<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Comment;
use App\Models\Tag;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $comments = Comment::whereCommentableType(Post::class)->paginate(12);

        return view('admin.comment.index', [
            'comments' => $comments,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return new JsonResponse(['message' => trans('comments.deleted')]);
    }
}
