<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Forum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/signin">Вход</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/signup">Регистрация</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/signout">Выход</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/addNew">Добавить</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Профиль</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    
    <div class="container">
        <h2 class="m-3">Последние посты</h2>
        <div class="d-flex flex-wrap flex_item">
            @foreach ($articles as $item)
                <div class="card post_position" style="width: 18rem;"
                    onclick="location.href='/articleView/{{ $item['id'] }}';">
                    <img src="/images/{{ $item['image'] }}" class="card-img-top "
                        onError="this.src='/images/default.png'">
                    <div class="card-body text_size">
                        <h5 class="card-title">{{ $item['title'] }}</h5>
                        @if (auth()->check())
                            @if (auth()->user()->status == 1)
                                <form method="POST" action="/delArticle/{{ $item['id'] }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @csrf
    <section id="courses">
        <div class="container">
            <h2 class="m-3">Категории</h2>
            <div class="d-flex flex-wrap">
                @foreach ($categories as $item)
                    <div class="card" style="width: 18rem;"
                        onclick="location.href='/articlesView/{{ $item['id'] }}';">
                        <img src="images/{{ $item['image'] }}" class="card-img-top"
                            onError="this.src='images/default.png'">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            @if (auth()->check())
                                @if (auth()->user()->status == 1)
                                    <form method="POST" action="/delCategory/{{ $item['id'] }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</body>
<footer>
</footer>

</html>
