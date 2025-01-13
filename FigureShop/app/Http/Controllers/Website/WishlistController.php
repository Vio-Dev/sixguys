<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // public function index()
    // {
    //      $userId = Auth::id();
    //         $Renderwishlist = Wishlist::with(['items.product', 'items.productVariant.variantValue'])
    //             ->where('user_id', $userId)
    //             ->first();
    //         return view('website.profile.wishlist', compact('Renderwishlist'));
    // }

  public function add(Request $request, FlasherInterface $flasher)
    {
        $productId = $request->input('product_id');

        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $userId,
        ]);

        // Thêm hoặc cập nhật WishlistItem
    $wishlistItem = WishlistItem::where('wishlist_id', $wishlist->id)
        ->where('product_id', $productId)
        ->first();

    if (!$wishlistItem) {
        $wishlistItem = new WishlistItem();
        $wishlistItem->wishlist_id = $wishlist->id; // Gán giá trị chính xác
        $wishlistItem->product_id = $productId;
        $wishlistItem->save();

        $flasher->addFlash('success', 'Đã thêm sản phẩm vào danh sách yêu thích', [], 'Thành công');
    } else {
        $flasher->addFlash('error', 'Sản phẩm đã tồn tại trong danh sách yêu thích', [], 'Thất bại');
    }
        return back();
    }

    public function remove(Request $request, FlasherInterface $flasher)
    {
        $productId = $request->input('product_id');

        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $userId,
        ]);

        // Xóa WishlistItem
        WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', $productId)
            ->delete();

        $flasher->addFlash('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích', [], 'Thành công');

        return back();
    }
}
