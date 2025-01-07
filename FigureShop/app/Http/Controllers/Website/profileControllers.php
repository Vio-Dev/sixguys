<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Flasher\Prime\FlasherInterface;

class profileControllers extends Controller
{
    public function index()
    {

        $user = Auth::user();
        return view('website.profile.index', compact('user'));
    }
    public function order()
    {

        $user = Auth::user();
        $userId = Auth::id();

        $orders = Order::with(['orderDetails.product', 'orderDetails.productVariant',])
            ->where('users_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('website.profile.order', compact('user', 'orders'));
    }
    public function orderDetail(Request $request)
    {
        $order = Order::with(['orderDetails.product', 'orderDetails.productVariant',])
            ->where('id', $request->id)
            ->first();

        return response()->json($order);
    }
    public function wishlist()
    {

        $user = Auth::user();
        return view('website.profile.wishlist', compact('user'));
    }
    public function logout(Request $request, FlasherInterface $flasher): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Assuming you want to always add the flash message
        if (true) {
            $flasher->addFlash('success', 'Đăng xuất thành công!', [], 'Thành công');
        }

        return redirect('/');
    }
}
