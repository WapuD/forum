<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</head>

<style>
    .post {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post_image {
        height: 200px;
        width: 200px;
    }

    .post_position {
        display: flex;
        flex-direction: row;
    }

    .text_size {
        min-width: 1000px;
        background: rgb(36, 36, 36);
    }

    .flex_item {
        flex-direction: column;
    }
</style>

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
                            <a class="nav-link" href="/signout">Выход</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <div class="container">
        <h2 class="m-3">Пост</h2>
        <div class="d-flex flex-wrap flex_item">
            @foreach ($articles as $item)
                <div class="card post_position" style="width: 18rem;">
                    <img src="/images/{{ $item['image'] }}" class="card-img-top "
                        onError="this.src='/images/default.png'">
                    <div class="card-body text_size">
                        <h5 class="card-title">{{ $item['title'] }}</h5>
                        <h5 class="card-title">{{ $item['text'] }}</h5>
                    </div>
                </div>
                <h2 class="m-3">Комментарии</h2>
                @auth
                    <form class="form-floating" method="POST" action="/addComment">
                        @csrf
                        <input type="text" class="form-control" id="text" placeholder="Напиши сюда коммент"
                            value="Крутой пост! Продолжай в том же духе!!!" name="text" required
                            value="{{ old('text') }}">
                        <input type="hidden" name="article_id" id="article_id" value="{{ $item['id'] }}">
                        @if (auth()->check())
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                        @endif
                        <label for="floatingInputValue">Напиши сюда коммент</label>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                @endauth
                <div class="d-flex flex-wrap flex_item">
                    @foreach ($comments as $item_zero)
                        @if ($item_zero['article_id'] == $item['id'])
                            <div class="card-body text_size">
                                <?php $user = App\Models\User::find($item_zero['user_id']); ?>
                                <h5 class="card-title">{{ $user->name }}: {{ $item_zero['text'] }}</h5>
                                @if (auth()->check())
                                    @if (auth()->user()->status == 1)
                                        <form method="POST" action="/delComment/{{ $item_zero['id'] }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>


    </div>
</body>

<footer>
</footer>

</html>
