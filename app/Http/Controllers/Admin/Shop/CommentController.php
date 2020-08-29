<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Shop\Product;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
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
        $comments = Comment::whereCommentableType(Product::class)->paginate(12);

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
