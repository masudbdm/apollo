@php
  $u = auth()->user();
  $canAnyUsers = $u && $u->hasAnyPermission(['user-show', 'user-create', 'user-edit', 'user-delete']);
  $canUserShow = $u && $u->hasAnyPermission(['user-show']);
  $canUserCreate = $u && $u->hasAnyPermission(['user-create']);
  $canRoleShow = $u && $u->hasAnyPermission(['role-show']);
  $canPermissionShow = $u && $u->hasAnyPermission(['permission-show']);
  $canAsignRole = $u && $u->hasAnyPermission(['asign-role']);
  $canAsignedRoleUsers = $u && $u->hasAnyPermission(['asigned-role-users']);
  $canRoleMenuShow = $u && $u->hasAnyPermission(['role-menu-show']);
@endphp

@if ($canAnyUsers)
  <li class="nav-item {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Users
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @if ($canUserShow)
          <li class="nav-item">
            <a href="{{ route('admin.usersAll') }}" class="nav-link {{ session('lsbsm') == 'usersAll' ? ' active ' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Users All</p>
            </a>
          </li>
        @endif

        @if ($canUserCreate)
          <li class="nav-item">
            <a href="{{ route('admin.userCreate') }}" class="nav-link {{ session('lsbsm') == 'userCreate' ? ' active ' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Create New User</p>
            </a>
          </li>
        @endif
      </ul>
    </li>
@endif


@if($canRoleMenuShow)
   <li class="nav-item {{ session('lsbm') == 'rolepermission' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Roles & Permissions
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @if($canRoleShow)
        <li class="nav-item">
          <a href="{{ route('admin.rolesAll') }}" class="nav-link  {{ session('lsbsm') == 'rolesAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Roles All</p>
          </a>
        </li> 
      @endif

      @if($canPermissionShow)
        <li class="nav-item">
          <a href="{{ route('admin.permissionsAll') }}" class="nav-link  {{ session('lsbsm') == 'permissionsAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Permissions All</p>
          </a>
        </li>
      @endif

      @if($canAsignRole)
        <li class="nav-item">
          <a href="{{ route('admin.assignRole') }}" class="nav-link  {{ session('lsbsm') == 'assignRole' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Asign Role</p>
          </a>
        </li>
      @endif

      @if($canAsignedRoleUsers)
        <li class="nav-item">
          <a href="{{ route('admin.roleUsers') }}" class="nav-link  {{ session('lsbsm') == 'mangeRole' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Role Users</p>
          </a>
        </li>
      @endif

    </ul>
  </li>
@endif