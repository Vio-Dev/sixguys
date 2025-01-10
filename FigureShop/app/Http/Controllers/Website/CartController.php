<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\WishlistItem;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        $cart = Cart::with(['items.product', 'items.productVariant.variantValue'])
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        return view('website.cart.index', compact('cart'));
    }

    public function add(Request $request, FlasherInterface $flasher)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity');
        $productPrice = $request->input('price');
        $wishlistId = $request->input('wishlist_id');

        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
            'status' => 'active',
        ]);

        // Kiểm tra sản phẩm tồn tại
        $product = Product::find($productId);
        if (!$product || $product->inStock < $quantity) {
            $flasher->addFlash('error', 'Số lượng hàng vượt quá mức. Vui long liên hệ admin', [], 'Thất bại');
        }

        // Thêm hoặc cập nhật CartItem
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'product_variant_id' => $variantId,
                'quantity' => $quantity,
                'price' => $productPrice,
            ]);
        }

        if ($cartItem->save()) {
            $flasher->addFlash('success', 'Thêm vào giỏ hàng thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi. Vui lòng thử lại.', [], 'Thất bại');
        }

        // Cập nhật tồn kho
        $product->decrement('inStock', $quantity);

       if (isset($wishlistId) && !is_null($wishlistId)) {
    $userId = Auth::id(); // Lấy ID người dùng hiện tại

    // Lấy hoặc tạo giỏ hàng cho người dùng
    $wishlist = Wishlist::firstOrCreate([
        'user_id' => $userId,
    ]);

    // Xóa WishlistItem
    WishlistItem::where('wishlist_id', $wishlist->id)
        ->where('product_id', $wishlistId)
        ->delete();
}

        return back();
    }

    public function update(Request $request, FlasherInterface $flasher)
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        $product = Product::find($productId);

        $inStock = $product->inStock;

        if ($quantity > $inStock) {
            $flasher->addFlash('error', 'Số lượng hàng vượt quá mức. Vui long liên hệ admin', [], 'Thất bại');
            return back();
        }

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            $flasher->addFlash('success', 'Cập nhật giỏ hàng thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi. Vui lòng thử lại.', [], 'Thất bại');
        }
        return back();
    }


    public function remove(Request $request, FlasherInterface $flasher)
    {
        $productId = $request->input('product_id');
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem->delete()) {
            $flasher->addFlash('success', 'Xóa sản phẩm khỏi giỏ hàng thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi. Vui lòng thử lại.', [], 'Thất bại');
        }
        return back();
        // dd($request->all());
    }

    public function clear() {}
}
