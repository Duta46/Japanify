<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Reset CSS */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        /* Message */
        .message {
            margin-bottom: 20px;
        }

        .message p {
            color: #555;
        }

        /* Button */
        .button {
            text-align: center;
        }

        .button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
        </div>
        <div class="message">
            <p>Hello,</p>
            <p>Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.</p>
        </div>
        <div class="button">
            <a href="{{ route('validasi-forgot-password', ['token' => $token]) }}">Reset Password</a>
        </div>
        <div class="footer">
            <p>Japanify</p>
        </div>
    </div>
</body>

</html>
