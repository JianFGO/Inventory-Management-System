<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="Avatar" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    Hi, {{ Auth::user()->name }}
                </div>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title"></div>
                    <a href="profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>

                    @role('Admin|Manager')
                        <a href="order" class="dropdown-item has-icon">
                            <i class="fas fa-receipt"></i> View Orders
                        </a>
                    @endrole

                    <a href="{{ route('product.index') }}" class="dropdown-item has-icon">
                        <i class="fas fa-box-open"></i> View Products
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="logout-nav-link"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i><span style="padding-left: 13px">Log Out</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </div>
        </li>
    </ul>
</nav>
