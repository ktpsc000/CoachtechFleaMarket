<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <a href="/" class="header__logo">
                <img src="{{asset('storage/COACHTECHヘッダーロゴ.png')}}" alt="COACHTECH">
            </a>

            <div class="header-nav">
                <a href="" class="header-nav__logout">ログアウト</a>
                <a href="" class="header-nav__mypage">マイページ</a>
                <a href="" class="header-nav__listing">出品</a>
            </div>

        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>