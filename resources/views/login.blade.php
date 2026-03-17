<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login — Telkom University</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #f4f7ff, #e8ecf7);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px;
            width: 360px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #d81e3a;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4b8df8;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover {
            background: #2c72e3;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
