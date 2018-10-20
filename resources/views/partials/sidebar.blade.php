<!-- Sidebar -->
<ul class="sidebar navbar-nav ">
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('/') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

</ul>