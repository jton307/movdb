
<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
  <div class="menu-list">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
          <li class="nav-divider">
            Menu
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
              <i class="fas fa-fw fa-file"></i>Posts</a>
            <div id="submenu-1" class="collapse submenu">

              <ul class="nav flex-column">

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin_posts') }}">All posts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin_posts.create') }}">New post</a>
                </li>

              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_categories') }}"><i class="fas fa-fw fa-table"></i>Categories</a>
          </li>
          @if(Auth::user()->isAdmin())
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
                <i class="fa fa-fw fa-user-circle"></i>Users</a>
              <div id="submenu-5" class="collapse submenu" style="">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin_users') }}">All users</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin_users.create') }}">New user</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('admin_site')}}"><i class="fa fa-fw fa-rocket"></i>Site</a>
            </li> @endif
        </ul>
      </div>
    </nav>
  </div>
</div>