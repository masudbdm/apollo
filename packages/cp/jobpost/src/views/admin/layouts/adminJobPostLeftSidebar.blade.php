@php
  $user = auth()->user();
  $canJobPostMenuShow = $user && method_exists($user, 'hasAnyPermission')
      ? $user->hasAnyPermission(['job-post-menu-show'])
      : false;
  $canJobPostShow = $user && method_exists($user, 'hasAnyPermission')
      ? $user->hasAnyPermission(['job-post-show'])
      : false;
@endphp

@if($canJobPostMenuShow)
 <li class="nav-item  {{ session('lsbm') == 'jobPost' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-folder"></i>
      <p>
        Job Post
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      @if($canJobPostShow)
        <li class="nav-item">
          <a href="{{ route('admin.jobPostsAll')}}" class="nav-link {{ session('lsbsm') == 'jobPostsAll' ? ' active ' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Job Posts All</p>
          </a>
        </li>
      @endif
        


    </ul>
  </li>
@endif