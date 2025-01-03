<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
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
        // Cập nhật trạng thái đơn hàng
        $order->status = 'confirmed';
        $order->save();

        // Thông báo thành công
        return view('website.order.confirm-success', ['order' => $order]);
    }
}
