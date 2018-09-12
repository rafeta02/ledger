<!-- ========== Topbar ========== -->
<div class="topbar">
  <div class="topbar-left">
    <div class="text-center">
      <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span><img src="https://www.befreetour.com/src/bismillah/img/logo-footer-id.png" height="27px"></span></a>
    </div>
  </div>

  <div class="navbar navbar-default" role="navigation">
    <div class="container">
      <ul class="nav navbar-nav navbar-right pull-right">
        <li class="dropdown top-menu-item-xs">
            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu">
              @can('Administrator')
                <li><a href="{{ route('users.index') }}"><i class="ti-user m-r-10 text-custom"></i> User</a></li>
                <li><a href="{{ route('roles.index') }}"><i class="ti-settings m-r-10 text-custom"></i> Role</a></li>
                <li><a href="{{ route('permissions.index') }}"><i class="ti-settings m-r-10 text-custom"></i> Permission</a></li>
                <li class="divider"></li>
              @endcan
                <li><a href="{{ route('logout') }}" 
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- Topbar End -->
