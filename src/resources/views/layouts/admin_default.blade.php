<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLovely - 管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLovely</h1>
            <nav class="header__nav">
                @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="header__link--logout">logout</button>
                </form>
            @endauth

            @guest
                @if(Request::is('login'))
                    <a href="/register" class="header__link--logout" style="text-decoration: none;">register</a>
                @elseif(Request::is('register'))
                    <a href="/login" class="header__link--logout" style="text-decoration: none;">login</a>
                @endif
            @endguest
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
