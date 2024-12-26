<?php

namespace App\Services;

use App\Models\{Cart, CartItem, Product};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function addCart($productId, $quantity = 1, $variantId = null)
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
            'status' => 'active',
        ]);

        // Kiểm tra sản phẩm tồn tại
        $product = Product::find($productId);
        if (!$product || $product->inStock < $quantity) {
            throw new \Exception('Sản phẩm không đủ hàng hoặc không tồn tại');
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
                'price' => $product->price,
            ]);
        }

        $cartItem->save();

        // Cập nhật tồn kho
        $product->decrement('inStock', $quantity);

        return $cartItem;
    }

    /**
     * Xoá sản phẩm khỏi giỏ hàng
     */
    public function removeCart($productId, $variantId = null)
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            throw new \Exception('Không tìm thấy giỏ hàng');
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            // Hoàn lại tồn kho
            $product = Product::find($productId);
            $product->increment('inStock', $cartItem->quantity);

            // Xoá CartItem
            $cartItem->delete();
        } else {
            throw new \Exception('Không tìm thấy sản phẩm trong giỏ hàng');
        }

        return true;
    }

    /**
     * Giảm số lượng sản phẩm trong giỏ hàng
     */
    public function subtractQuantity($productId, $quantity = 1, $variantId = null)
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->where('status', 'active')->first();

        if (!$cart) {
            throw new \Exception('Không tìm thấy giỏ hàng');
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > $quantity) {
                $cartItem->quantity -= $quantity;
                $cartItem->save();

                // Hoàn lại tồn kho
                $product = Product::find($productId);
                $product->increment('inStock', $quantity);
            } else {
                throw new \Exception('Số lượng sản phẩm không đủ để giảm');
            }
        } else {
            throw new \Exception('Không tìm thấy sản phẩm trong giỏ hàng');
        }

        return $cartItem;
    }
}
