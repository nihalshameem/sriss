<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light fixed-top" style="background-color:#fafafa">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:#3e3e3e"></i></a>
    </li>
</ul>
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" role="button" style="color:#3e3e3e">
            <?php
            $user = App\Models\User::where('name',Session::get('name'))->first();

            $roles = DB::table('users_roles')->where('user_id',$user->id)->first();

            $role = DB::table('roles')->where('id',$roles->role_id)->first();
            ?>
            {{$role->name}}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" role="button" 
        href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" style="color:#3e3e3e">
        <i class="fas fa-sign-out-alt"> Logout</i>
    </a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
</ul>
</nav>
  <!-- /.navbar -->