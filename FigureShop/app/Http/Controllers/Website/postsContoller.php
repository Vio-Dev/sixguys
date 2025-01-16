<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Rating;
use Flasher\Prime\FlasherInterface;

class postsContoller extends Controller
{
    public function index()
    {

        // return view('website.posts.index');
    }
    public function show($id)
    {
        $post = Post::with('user')->find($id);
        $comments = Rating::with('user')->where('post_id', $id)->where('isHidden', 0)->get();
        return view('website.post.detail', compact('post', 'comments'));
    }
    public function postComments(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required',
            'rating' => 'required',
        ]);
        $comment = new Rating();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->rating = $request->rating;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        $flasher->addFlash('success', 'Bình luận của bạn đã được gửi!', [], 'Thành công');

        return back();
    }
    public function postsCommentsDelete(Request $request, FlasherInterface $flasher)
    {
        $id = $request->post_id;
        $comment = Rating::findOrFail($id);
        $user = auth()->user();

        if ($comment->user_id === $user->id) {
            $comment->isHidden = true;
            $comment->save();
            $flasher->addFlash('success', 'Bình luận của bạn đã được xóa!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Bạn không có quyền xóa bình luận này', [], 'Lỗi');
        }

        return back();
    }
}
