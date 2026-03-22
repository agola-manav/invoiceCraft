<ul class="list-unstyled topnav-menu float-end mb-0">

    <li class="dropdown notification-list topbar-dropdown">
        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
            <span class="pro-user-name ms-1">
                {{ auth()->user()->name }} <i class="uil uil-angle-down"></i> 
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome {{ auth()->user()->name }} !</h6>
            </div>

            <a href="#" type="button" class="dropdown-item notify-item edit-profile" data-id="">
                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
            </a>

            <div class="dropdown-divider"></div>

            <a onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" href="{{ route('user.logout.post') }}" class="dropdown-item notify-item">
                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
            </a>

        </div>
    </li>

</ul>