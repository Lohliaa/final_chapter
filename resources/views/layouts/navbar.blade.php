<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item" style="margin-left: 5pt; margin-bottom: 10pt;">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto mb-0">
    <!-- Messages Dropdown Menu -->
    <!-- Notifications Dropdown Menu -->
    @auth
    <h4 class="mr-1 mt-2 d-md-inline text-gray-300">{{ Auth::user()->name }}</h4>
    @endauth
    
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="mt-1 btn btn-danger" style="margin-right: 10pt; margin-left: 5pt;">Logout</button>
  </form>
    
  </ul>
</nav>
