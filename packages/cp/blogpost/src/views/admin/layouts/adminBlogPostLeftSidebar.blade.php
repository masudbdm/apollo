@php
  $u = auth()->user();
  $canBlogMenuShow = $u && $u->hasAnyPermission(['blog-menu-show']);
  $canPostCategoryShow = $u && $u->hasAnyPermission(['post-category-show']);
  $canPostShow = $u && $u->hasAnyPermission(['post-show']);
@endphp

@if($canBlogMenuShow)
 <li class="nav-item  {{ session('lsbm') == 'blogPost' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-folder"></i>
              <p>
                Blog Post
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if($canPostCategoryShow)
                <li class="nav-item">
                  <a href="{{ route('admin.blogCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'blogCategoriesAll' ? ' active ' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blog Categories All</p>
                  </a>
                </li>
              @endif
              

              @if($canPostShow)
                <li class="nav-item">
                  <a href="{{ route('admin.blogPostsAll')}}" class="nav-link {{ session('lsbsm') == 'blogPostsAll' ? ' active ' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blog Posts All</p>
                  </a>
                </li>
              @endif
               
            </ul>
          </li>
@endif