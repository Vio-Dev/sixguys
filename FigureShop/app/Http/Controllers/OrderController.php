<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['orderDetails.product', 'orderDetails.productVariant'])->where('users_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['orderDetails.product', 'orderDetails.productVariant'])->where('id', $id)->first();

        if (!$order) {
            return abort(404, 'Không tìm thấy đơn hàng');
        }

        $products = $order->orderDetails->map(function ($item) {
            return [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'thumbnail' => $item->product->thumbnail,
                'variant' => $item->productVariant ? $item->productVariant->variantValue->value : null,
                'discount' => $item->product->discount,
                'total' => $item->price * $item->quantity - $item->price * $item->quantity * $item->product->discount / 100,
            ];
        });

        return response()->json($products);
    }


    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus(Request $request, FlasherInterface $flasher, string $id)
    {

        $status = $request->input('status');
        $note = $request->input('note');
        $order = Order::find($id);

        if (!$order) {
            $flasher->addFlash('error', 'Không tìm thấy đơn hàng!', [], 'Thất bại');
            return back();
        }

        $order->status = $status;
        $order->note = $note;

        if ($order->save()) {
            $flasher->addFlash('success', 'Cập nhật trạng thái đơn hàng thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Có lỗi xảy ra!', [], 'Thất bại');
        }

        return back();
    }

    public function destroy(string $id)
    {
        //
    }

    public function confirm($orderId, $userId)
    {
        // Tìm đơn hàng với điều kiện khớp user_id và order_id
        $order = Order::where('id', $orderId)->where('users_id', $userId)->first();

        if (!$order) {
            return abort(404, 'Không tìm thấy đơn hàng');
        }

        if ($order->status !== 'pending') {
            return view('website.order.confirm-success', ['order' => $order, 'message' => 'Đơn hàng đã được xác nhận']);
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = 'confirmed';
        $order->save();

        // Thông báo thành công
        return view('website.order.confirm-success', ['order' => $order]);
    }

    public function cancel(Request $request,  FlasherInterface $flasher, $orderId)
    {
        $orderNote = $request->input('note');
        $userId = auth()->id();
        // Tìm đơn hàng với điều kiện khớp user_id và order_id
        $order = Order::where('id', $orderId)->where('users_id', $userId)->first();
        $order->load(['orderDetails.product', 'orderDetails.productVariant']);


        if (!$order) {
            return abort(404, 'Không tìm thấy đơn hàng');
        }

        if ($order->status !== 'pending' && $order->status !== 'confirmed') {
            $flasher->addFlash('error', 'Đơn hàng không thể hủy!', [], 'Thất bại');
            return back();
        }

        // Hoàn lại số lượng sản phẩm
        foreach ($order->orderDetails as $item) {
            $product = $item->product;
            $productVariant = $item->productVariant;
            if ($product) {
                $product->inStock += $item->quantity;
                $product->hasSold -= $item->quantity;
                $product->save();
            }
            if ($productVariant) {
                $productVariant->inStock += $item->quantity;
                $product->hasSold -= $item->quantity;
                $productVariant->save();
            }
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->note = $orderNote;

        if ($order->save()) {
            $flasher->addFlash('success', 'Đơn hàng đã được xác nhận!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã có lỗi xảy ra!', [], 'Thất bại');
        }

        return back();
    }
}
