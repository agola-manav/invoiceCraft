<!--- Sidemenu -->
<div id="sidebar-menu">

    <ul id="side-menu">

        <!-- <li class="menu-title">Navigation</li> -->

        <li>
            <a href="{{ route('manager.dashboard') }}">
                <i data-feather="home"></i>
                <span> Dashboard </span>
            </a>
        </li>

        <li>
            <a href="{{ route('manager.member') }}">
                <i class="uil uil-user"></i>
                <span> Members </span>
            </a>
        </li>

    </ul>
</div>