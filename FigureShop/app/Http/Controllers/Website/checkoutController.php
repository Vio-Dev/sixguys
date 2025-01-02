<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $userId = Auth::id();

        $cart = Cart::with(['items.product', 'items.productVariant.variantValue'])
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        return view('website.checkout.index', compact('user', 'cart'));
    }
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate(
            [
                'name' => "required|min:3|max:100|string",
                'phone' => "required",
                'email' => "required",
                'address' => "required",
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute không ít hơn :min ký tự.',
                'max' => ':attribute không vượt quá :max ký tự.',
            ],
            [
                'name' => 'Tên người nhận',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'address' => 'Địa chỉ',

            ]
        );

        $input = $request->all();

        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        $cart = Cart::with(['items.product', 'items.productVariant.variantValue'])
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->first();
    }
}
