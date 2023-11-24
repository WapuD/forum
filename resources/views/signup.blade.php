<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <form method="POST" action="/signup/valid">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Введите электронную почту</label>
              <input type="email" class="form-control" id="email" name="user_email" aria-describedby="emailHelp">
              @error('email')
                  <p style="color: red">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="user_name" class="form-label">Введите имя</label>
              <input type="user_name" class="form-control" id="user_name" name="user_name">
              @error('name')
                  <p style="color: red">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Введите пароль</label>
              <input type="password" class="form-control" id="password" name="password">
              @error('password')
                  <p style="color: red">{{$message}}</p>
              @enderror
            </div>
            <button type="submit" class="btn btn-info">Зарегистрироваться</button>
          </form>
    </div>
</body>
</html>
