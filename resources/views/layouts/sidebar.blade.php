<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">
    <div id="sidebar-menu">
      <ul>
        <li class="active">
          <a href="#" class="waves-effect"><i class="ti-home"></i> <span> Home </span></a>
        </li>

        <li class="has_sub">
          <a class="waves-effect"><i class="ti-user"></i> <span> Chart Of Account </span> <span class="menu-arrow"></span> </a>
          <ul class="list-unstyled">
            <a href="{{route('coa.index')}}">Manage Chart Of Account</a>
            <a href="{{route('type-coa.index')}}">Manage Type of COA</a>
          </ul>
        </li>

        <li class="has_sub">
          <a class="waves-effect"><i class="ti-credit-card"></i><span> Journal </span> <span class="menu-arrow"></span></a>
          <ul class="list-unstyled">
            @can('Create_Journal')
            <li><a href="{{route('journal.index')}}">Create New Journal</a></li>
            @endcan
            @can('Posting_Journal')
            <li><a href="{{route('journal.posting')}}">Journal Posting</a></li>
            @endcan
          </ul>
        </li>
        <li class="has_sub">
          <a class="waves-effect"><i class="ti-credit-card"></i><span> General Ledger </span><span class="menu-arrow"></span></a>
          <ul class="list-unstyled">

            <li><a href="{{route('ledger.index')}}">Ledger</a></li>
            <li><a href="{{route('ledger.monthly')}}">Summary</a></li>
          </ul>
        </li>
        @can('View_Labarugi')
        <li class="has_sub">
          <a href="{{route('labarugi.index')}}" class="waves-effect"><i class="ti-credit-card"></i><span> Labarugi </span></a>
        </li>
        @endcan
        @can('View_Neraca')
        <li class="has_sub">
          <a href="{{route('neraca.index')}}" class="waves-effect"><i class="ti-credit-card"></i><span> Neraca </span></a>
        </li>
        @endcan
        @can('Setup_Settings')
        <li class="has_sub">
          <a class="waves-effect"><i class=" ti-settings"></i><span> Setup </span> <span class="menu-arrow"></span></a>
          <ul class="list-unstyled">
            <li><a href="{{route('setup.labarugi.index')}}">Setup Labarugi</a></li>
            <li><a href="{{route('setup.neraca.index')}}">Setup Neraca</a></li>
          </ul>
        </li>
        @endcan
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
