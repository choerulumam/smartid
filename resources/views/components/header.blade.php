<header class="main-header hidden-print"><a class="logo" href="#"><strong>SMART</strong> ID <i class="fa fa-cogs" aria-hidden="true"></i></a>
    <nav class="navbar navbar-static-top">
        <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
        <div class="navbar-custom-menu">
            <ul class="top-nav">
                <li><a {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                	{{ csrf_field() }}
                 </form>
            </ul>
        </div>
    </nav>
</header>