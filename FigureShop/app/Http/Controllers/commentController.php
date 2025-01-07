<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Flasher\Prime\FlasherInterface;

class commentController extends Controller
{
    public function post()
    {
        $comments = Rating::with(['user', 'post'])
         ->whereNotNull('post_id')
        ->orderBy('created_at', 'DESC')
            ->paginate(10);
       return view('admin.comment.posts',compact('comments'));
    }

    public function updatePost( Request $request, FlasherInterface $flasher)
    {
        $comment = Rating::find($request->id);
        $comment->isHidden = true;
        $comment->save();
        $flasher->addSuccess('Bình luận đã được ẩn');
       return back();
    }
    public function deletePost(Request $request, FlasherInterface $flasher)
    {
        $comment = Rating::find($request->id);
        $comment->delete();
        $flasher->addSuccess('Bình luận đã được xóa');
        return back();
    }
 public function product()
    {
        $comments = Rating::with(['user', 'product'])
         ->whereNotNull('product_id')
        ->orderBy('created_at', 'DESC')
            ->paginate(10);
       return view('admin.comment.products',compact('comments'));
    }

     public function updateProduct( Request $request, FlasherInterface $flasher)
    {
        $comment = Rating::find($request->id);
        $comment->isHidden = true;
        $comment->save();
        $flasher->addSuccess('Bình luận đã được ẩn');
       return back();
    }
    public function deleteProduct(Request $request, FlasherInterface $flasher)
    {
        $comment = Rating::find($request->id);
        $comment->delete();
        $flasher->addSuccess('Bình luận đã được xóa');
        return back();
    }

}
