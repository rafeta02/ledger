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
            <li><a href="{{route('journal.index')}}">Create New Journal</a></li>
            <li><a href="{{route('journal.posting')}}">Journal Posting</a></li>
          </ul>
        </li>

        <li class="has_sub">
          <a href="{{route('ledger.index')}}" class="waves-effect"><i class="ti-credit-card"></i><span> General Ledger </span></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
