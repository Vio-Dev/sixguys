<!DOCTYPE html>
<html>

<head>
    <style>
        /* Dùng style inline cho email */
        .email-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .email-content {
            font-family: Arial, sans-serif;

        }

        .header__mail {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .nofication__mail {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .alert__mail {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body class="email-content">

    <div class="header__mail">Xin chào!</div>

    <div class="nofication__mail">Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu từ tài khoản
        của bạn.</div>

    <a href="{{ $url }}" class="email-button">Đặt lại mật khẩu</a>

    <div class="alert__mail">Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</div>

    <div>Trân trọng,<br>FigureShop</div>
</body>

</html>
