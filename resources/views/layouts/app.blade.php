<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Gallery</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        nav {
            background: #222;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        input {
            padding: 10px;
            margin: 5px 0 15px;
            width: 100%;
            box-sizing: border-box;
        }

        button,
        .btn {
            padding: 10px 18px;
            background: #222;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .delete {
            background: #c0392b;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .gallery-item {
            background: white;
            padding: 10px;
            border-radius: 8px;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .actions {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .error {
            color: red;
        }

        .success {
            background: #d4edda;
            padding: 12px;
            margin-bottom: 15px;
        }

        .single-image {
            max-width: 100%;
            max-height: 600px;
        }
    </style>
</head>

<body>

<nav>

    <a href="{{ route('gallery.index') }}">
        My Gallery
    </a>

    @auth
        <div>
            {{ auth()->user()->name }}

            <form action="{{ route('logout') }}"
                  method="POST"
                  style="display:inline">

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>
        </div>
    @endauth

</nav>

<div class="container">

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>