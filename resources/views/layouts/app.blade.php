<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield("title")</title>
</head>
<body class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('posts.index') }}">
            <i class="fa-solid fa-blog"></i>
            Blog
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
              </li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" > 
                  @csrf
                  <input type="submit" value="logout" class="btn btn-secondary ">
                </form>
              </li>
              <li class="nav-item dropdown">
                @can('manageUser',Auth::user())
                <a class="nav-link dropdown-toggle" href="{{route('users.dashboard')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dashboard
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('users.index')}}">Users</a></li>
                  <li><a class="dropdown-item" href="{{route('categories.index')}}">Categories</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('tags.index')}}">Tags</a></li>
                </ul>
                @endcan
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add New
                </a>
                <ul class="dropdown-menu">
                  @can('manageUser',Auth::user())
                  <li><a class="dropdown-item" href="{{route('users.create')}}">Add new user</a></li>
                  <li><a class="dropdown-item" href="{{route('categories.create')}}">Add new category</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('tags.create')}}">Add new tag</a></li>
                  @endcan
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">@Ghena</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    @yield("content")
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
</body>
</html>