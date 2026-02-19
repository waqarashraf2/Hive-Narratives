{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page Not Found - 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
        }

        h1 {
            font-size: 100px;
            color: #6c63ff;
        }

        h2 {
            font-size: 24px;
            margin: 20px 0;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #6c63ff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        a:hover {
            background-color: #574fd6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Page not found</h2>
        <p>The page you’re looking for doesn’t exist or has been moved.</p>
        <a href="{{ url('/') }}">Go to Homepage</a>
    </div>
</body>
</html>
