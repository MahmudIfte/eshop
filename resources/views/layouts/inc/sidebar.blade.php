<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">

    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('/dashboard') ? 'active':''}}  ">
                <a class="nav-link" href="#">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('categories') ? 'active':''}}">
                <a class="nav-link" href="{{ url('categories') }}">

                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-category') ? 'active':''}}">
                <a class="nav-link" href="{{ url('add-category') }}">
                    {{-- <i class="material-icons">person</i> --}}
                    <p>Add-category</p>
                </a>
            </li>





            <li class="nav-item {{ Request::is('products') ? 'active':''}}">
                <a class="nav-link" href="{{ url('products') }}">

                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-products') ? 'active':''}}">
                <a class="nav-link" href="{{ url('add-products') }}">
                    {{-- <i class="material-icons">person</i> --}}
                    <p>Add-Products</p>
                </a>
            </li>





            <li class="nav-item {{ Request::is('orders') ? 'active':''}}"">
                <a class="nav-link" href="{{ url('orders') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Orders</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('users') ? 'active':''}}"">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="material-icons">person</i>
                    <p>Total customers</p>
                </a>
            </li>
            {{-- <li class="nav-item ">
                <a class="nav-link" href="./typography.html">
                    <i class="material-icons">library_books</i>
                    <p>Typography</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./icons.html">
                    <i class="material-icons">bubble_chart</i>
                    <p>Icons</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./map.html">
                    <i class="material-icons">location_ons</i>
                    <p>Maps</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./notifications.html">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
