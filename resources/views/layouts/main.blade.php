<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Posts</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary"  data-bs-theme="dark">
        <div class="container container-fluid">
            <a class="navbar-brand" href="#">Example App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                    </li>
                    @can('view', auth()->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.posts.index') }}">Admin</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>