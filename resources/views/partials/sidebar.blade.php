<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            {{-- Link for dashboard --}}
            <li class="menu-header">Dashboard</li>

            <!--Changes navbar link colour when user is on the page-->
            <li class="dropdown {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            {{-- Link for category --}}
            <li class="dropdown {{ request()->is('category/*') || request()->is('category') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-tags"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('category.create') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('category.create') }}">Add Category</a></li>
                    <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('category.index') }}">All Categories</a></li>
                </ul>
            </li>

            {{-- Link for products --}}
            <li class="dropdown {{ request()->is('product/*') || request()->is('product') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box-open"></i><span>Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('product.create') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('product.create') }}">Add Product</a></li>
                    <li class="{{ request()->routeIs('product.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('product.index') }}">All Products</a></li>
                </ul>
            </li>
            {{-- Link for orders --}}
            <li class="dropdown {{ request()->is('order/*') || request()->is('order') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-receipt"></i><span>Order</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('order.create') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('order.create') }}">New Order</a></li>
                    <li class="{{ request()->routeIs('order.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('order.index') }}">All Orders</a></li>
                </ul>
            </li>

            <li class="menu-header">Log Out</li>
            <li>
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-fire"></i><span>Log Out</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </aside>
</div>
