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

    .text_area_size {
        width: 100%;
        height: 300px;
        resize: none;
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
        </div>
    </nav>
</header>

<body>
    <form class="form" method="POST" action="/addArticle">
        @csrf

        <h6>Выбери категорию и изображение для поста</h6>
        <select class="form-select" aria-label="Default select example" name="category">
            @foreach ($categories as $item)
                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
            @endforeach
        </select>
        <div class="mb-3">
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <input type="title" class="form-control" id="title" placeholder="Напиши сюда название поста"
            name="title" required value="{{ old('title') }}">

        <textarea type="text" class="form-control text_area_size" id="text" placeholder="Напиши сюда текст поста"
            name="text" required value="{{ old('text') }}"></textarea>

        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-primary">Создать пост</button>
    </form>

    @if (auth()->user()->status == 1)
        <form class="form" method="POST" action="/addCategory">
            @csrf

            <h6>Выбери изображение для категории</h6>
            <div class="mb-3">
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <input type="title" class="form-control" id="title" placeholder="Напиши сюда название категории"
                name="title" required value="{{ old('text') }}">

            <button type="submit" class="btn btn-primary">Создать категорию</button>
        </form>
    @endif
</body>
<footer>
</footer>

</html>
