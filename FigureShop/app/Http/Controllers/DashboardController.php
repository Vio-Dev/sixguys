<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Post;
use App\Models\Order;
// use App\Models\OrderDetail;


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

        //  // Doanh thu theo tuần
        // $weekly = Order::where('isDeleted', 0)
        //     ->selectRaw('WEEK(order_date) as week, SUM(total) as revenue')
        //     ->groupBy('week')
        //     ->pluck('revenue', 'week');

        // // Doanh thu theo tháng
        // $monthly = Order::where('isDeleted', 0)
        //     ->selectRaw('MONTH(order_date) as month, SUM(total) as revenue')
        //     ->groupBy('month')
        //     ->pluck('revenue', 'month');

        // // Doanh thu theo năm
        // $yearly = Order::where('isDeleted', 0)
        //     ->selectRaw('YEAR(order_date) as year, SUM(total) as revenue')
        //     ->groupBy('year')
        //     ->pluck('revenue', 'year');

          // Dữ liệu giả lập
        $weekly = [
            1 => 5000,
            2 => 10000,
            3 => 7500,
            4 => 12500,
        ];

        $monthly = [
            1 => 45000,
            2 => 52000,
            3 => 48000,
            4 => 60000,
            5 => 58000,
        ];

        $yearly = [
            2021 => 500000,
            2022 => 600000,
            2023 => 700000,
        ];

         // Truy vấn sản phẩm bán chạy
        // $bestSelling = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
        //     ->select('products.name as product_name', \DB::raw('SUM(order_details.quantity) as total_sold'))
        //     ->groupBy('products.name')
        //     ->orderBy('total_sold', 'DESC')
        //     ->take(10) // Lấy 10 sản phẩm bán chạy nhất
        //     ->get();

         $bestSelling = collect([
            (object) ['product_name' => 'Sản phẩm A', 'total_sold' => 150],
            (object) ['product_name' => 'Sản phẩm B', 'total_sold' => 120],
            (object) ['product_name' => 'Sản phẩm C', 'total_sold' => 100],
            (object) ['product_name' => 'Sản phẩm D', 'total_sold' => 90],
            (object) ['product_name' => 'Sản phẩm E', 'total_sold' => 80],
            (object) ['product_name' => 'Sản phẩm F', 'total_sold' => 70],
            (object) ['product_name' => 'Sản phẩm G', 'total_sold' => 60],
            (object) ['product_name' => 'Sản phẩm H', 'total_sold' => 50],
            (object) ['product_name' => 'Sản phẩm I', 'total_sold' => 40],
            (object) ['product_name' => 'Sản phẩm J', 'total_sold' => 30],
        ]);

        return view('admin.dashboard',compact('countUser','countProduct','countPost','weekly','monthly','yearly','bestSelling'));
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
