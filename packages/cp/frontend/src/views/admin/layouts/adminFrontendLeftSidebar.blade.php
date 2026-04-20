<li class="nav-item {{ session('lsbm') == 'frontend' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link {{ session('lsbm') == 'frontend' ? ' active ' : '' }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
            Contact Messages
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.contactMessages.index') }}" class="nav-link {{ session('lsbsm') == 'contact_messages' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Messages</p>
            </a>
        </li>
    </ul>
</li>

