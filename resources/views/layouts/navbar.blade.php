<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item" style="margin-left: 5pt; margin-bottom: 5pt;">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    @auth
    <div class="d-flex align-items-center">
      <h4 class="mt-3 text-gray-200">{{ Auth::user()->name }}</h4>

      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="mt-2 mb-1 btn btn-danger ml-2 mr-5">Logout</button>
      </form>
    </div>
    @endauth
  </ul>

</nav>