<?php

namespace App\Http\Controllers\Front\Shop;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => [Rule::requiredIf(Auth::guest())],
            'cell' => [Rule::requiredIf(Auth::guest()), 'cell'],
            'body' => ['required', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#leave-comment")->withErrors($validator)->withInput();
        }

        $comment = new Comment();
        $comment->ip = $request->ip();
        $comment->commentable_type = Product::class;
        $comment->commentable_id = $product->id;
        $comment->user_id = Auth::check() ? Auth::id() : null;
        $comment->name = $request->get('name');
        $comment->cell = $request->get('cell');
        $comment->body = $request->get('body');
        $comment->save();

        return back()->with('success', trans('comments.created'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
