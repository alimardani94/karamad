<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $comments = Comment::whereCommentableType(Post::class)->paginate(12);

        return view('pages.admin.comment.index', [
            'comments' => $comments,
        ]);
    }


    /**
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
