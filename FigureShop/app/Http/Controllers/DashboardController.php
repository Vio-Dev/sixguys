<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Post;
use App\Models\Order;
use App\Models\OrderDetail;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countUser = User::count();
        $countProduct = Product::count();
        $countPost = Post::count();
        $totalRevenue = Order::where('isDeleted', 0)->sum('total');

        //  // Doanh thu theo tuần
        $weekly = Order::where('isDeleted', 0)
            ->selectRaw('WEEK(order_date) as week, SUM(total) as revenue')
            ->groupBy('week')
            ->pluck('revenue', 'week');

        // Doanh thu theo tháng
        $monthly = Order::where('isDeleted', 0)
            ->selectRaw('MONTH(order_date) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month');

        // Doanh thu theo năm
        $yearly = Order::where('isDeleted', 0)
            ->selectRaw('YEAR(order_date) as year, SUM(total) as revenue')
            ->groupBy('year')
            ->pluck('revenue', 'year');

          // Dữ liệu giả lập
        // $weekly = [
        //     1 => 5000,
        //     2 => 10000,
        //     3 => 7500,
        //     4 => 12500,
        // ];

        // $monthly = [
        //     1 => 45000,
        //     2 => 52000,
        //     3 => 48000,
        //     4 => 60000,
        //     5 => 58000,
        // ];

        // $yearly = [
        //     2021 => 500000,
        //     2022 => 600000,
        //     2023 => 700000,
        // ];

         // Truy vấn sản phẩm bán chạy
        $bestSelling = Product::where('hasSold', '>', 0)
            ->orderBy('hasSold', 'desc')
            ->paginate(10);
        return view('admin.dashboard',compact('countUser','countProduct','countPost','weekly','monthly','yearly','bestSelling','totalRevenue'));
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
}
