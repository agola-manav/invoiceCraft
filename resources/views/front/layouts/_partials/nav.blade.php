<!--- Sidemenu -->
<div id="sidebar-menu">

    <ul id="side-menu">

        <!-- <li class="menu-title">Navigation</li> -->

        <li>
            <a href="{{ route('companies.index') }}">
                <i data-feather="home"></i>
                <span> Company </span>
            </a>
        </li>

        <li>
            <a href="{{ route('payment-mode.index') }}">
                <i data-feather="home"></i>
                <span> Payment Mode </span>
            </a>
        </li>

        <li>
            <a href="{{ route('expense-category.index') }}">
                <i data-feather="home"></i>
                <span> Expense Category </span>
            </a>
        </li>

    </ul>
</div>