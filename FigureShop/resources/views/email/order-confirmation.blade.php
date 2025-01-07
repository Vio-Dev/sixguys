<!DOCTYPE html>
<html>

<head>
    <title>Xác nhận đặt hàng</title>
</head>

<body>
    <h1>Cảm ơn bạn đã đặt hàng tại {{ config('app.name') }}</h1>
    <p>Xin chào {{ $order->user->name }},</p>
    <p>Chúng tôi đã nhận được đơn hàng của bạn.</p>
    <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
    <p><strong>Ngày đặt hàng:</strong> {{ $order->order_date }}</p>
    <p><strong>Tổng cộng:</strong> {{ number_format($order->total, 2) }} VND</p>

    <p>Chúng tôi sẽ giao hàng cho bạn sớm nhất có thể.</p>
    <p>
        <a href="{{ route('orders.confirm', ['order' => $order->id, 'user' => $order->user->id]) }}"
            style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
            Xác nhận đơn hàng
        </a>
    </p>

    <p>Trân trọng,<br>{{ config('app.name') }}</p>
</body>

</html>
