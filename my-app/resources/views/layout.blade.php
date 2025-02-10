<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Board App</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <nav class="p-4 flex items-center">
    <a href="{{ route('posts.index') }}">Board App</a>
    <span class="flex-1"></span>
    <div>
      <ul class="flex items-center gap-4">
        @if (auth()->check())
          {{-- ログアウトボタンの実装 --}}
          <li>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button class="border hover:bg-slate-300 p-1 rounded" type="submit">Logout</button>
            </form>
          </li>
        @else  
          {{-- ログインボタンの実装 --}}
          <li>
            <a href="{{ route('login') }}" class="border hover:bg-slate-300 p-1 rounded">Login</a>
          </li>
          {{-- ユーザー登録ボタンの実装 --}}
          <li>
            <a href="{{ route('register') }}" class="border hover:bg-slate-300 p-1 rounded">Register</a>
          </li>
        @endif
      </ul>
    </div>
  </nav>
  @yield('content')
</body>

</html>
