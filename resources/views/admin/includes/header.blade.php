<div class="dashboard-header">
<nav class="navbar navbar-expand-lg bg-white fixed-top">
  <a class="navbar-brand" href="index.html">MovDb</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto navbar-right-top">
      <li class="nav-item dropdown nav-user">
        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user mr-2"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
          <div class="nav-user-info">
            <h5 class="mb-0 text-white nav-user-name">{{Auth::user()->name}} </h5>
          </div>
          <!---Create log out form  -->
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>