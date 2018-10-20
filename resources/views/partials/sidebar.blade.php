<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item {{\Illuminate\Support\Facades\Request::is('/') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-fw fa-folder"></i>
            <span>Books</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(5px, 56px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item" href="{{route('books.listview')}}">List View</a>
            <a class="dropdown-item" href="{{route('books.listimport.index')}}">Import</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-fw fa-folder"></i>
            <span>Beneficiaries</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(5px, 56px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item" href="{{route('beneficiaries.listview')}}">List View</a>
            <a class="dropdown-item" href="{{route('beneficiaries.listimport.index')}}">Import</a>
        </div>
    </li>

</ul>