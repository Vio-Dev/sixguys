<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $orderDate = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $orderDate->toDateTimeString();
        $user = User::find($userId);


        if ($input['payment_method'] == 'cod') {
            if ($user->address == null) {
                $user->address = $input['address'];
                $user->save();
            }

            if ($user->phone == null) {
                $user->phone = $input['phone'];
                $user->save();
            }

            $order = Order::create([
                'users_id' => $userId,
                'order_date' => $orderDate,
                'total' => $input['grand_total'],
                'status' => 'pending',
                'note' => $input['note'],
                'payment_method' => $input['payment_method'],
            ]);

            foreach ($cart->items as $item) {

                $productVariantId = $item->product_variant_id ? $item->product_variant_id : null;

                $order->orderDetails()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                $product = $item->product;

                $product->inStock = $product->inStock - $item->quantity;
                $product->hasSold = $product->hasSold + $item->quantity;
                $product->save();
            }

            CartItem::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('status', 'active');
            })->delete();

            Mail::to($user->email)->send(new OrderConfirmationMail($order));

            $flasher->addSuccess('Đặt hàng thành công! Bạn sẽ nhận được email xác nhận đơn hàng trong ít phút.');

            return redirect()->route('ho-so.don-hang');
        } else {
            return 'Thanh toán online';
        }
    }
}
