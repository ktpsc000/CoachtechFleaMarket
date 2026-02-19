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
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>