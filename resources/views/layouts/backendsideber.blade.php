<nav class="side-nav">
    <a href="{{ route('frontend') }}" class="intro-x d-flex align-items-center ps-5 pt-4">
        <img alt="logo" style="width:80%" src="{{ asset('images/logo-dc.jpg') }}">
        <span class="d-none d-xl-block text-white fs-lg ms-3"><span class="fw-medium"></span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul <li>
        <a href="{{ route('deshboard') }}"
            class="side-menu {{ request()->routeIs('deshboard') ? 'side-menu--active side-menu--open' : ' ' }}">
            <div class="side-menu__icon"><i class="fa-solid fa-house"></i></div>
            <div class="side-menu__title">
                Dashboard
            </div>
        </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"><i class="fa-solid fa-users"></i></div>
                <div class="side-menu__title">
                    Customer
                    <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('getbooking_info') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-list"></i><div class="side-menu__title">Online Apply</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.customars') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-handshake"></i><div class="side-menu__title">Active Customer</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.customer_form') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-pen-to-square"></i><div class="side-menu__title">Add Customer</div>
                    </a>
                </li>
            </ul>
        </li>
    
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"><i class="fa-solid fa-receipt"></i></div>
                <div class="side-menu__title">
                    Report
                    <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('contact.report') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-file-lines"></i><div class="side-menu__title">Invoice</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.booking_money') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-dollar-sign"></i><div class="side-menu__title">Booking Money</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.down_money') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-money-check-dollar"></i><div class="side-menu__title">Due down Payment</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact.due_installment') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-brands fa-kickstarter-k"></i><div class="side-menu__title">Due Installments</div>
                    </a>
                </li>
               

                </ul>
        </li>
        <li>
            <a href="{{ route('user') }}" class="side-menu">
                <div class="side-menu__icon"><i class="fa-solid fa-user-tie"></i></div>
                <div class="side-menu__title">
                    User
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"><i class="fa-solid fa-gear"></i></div>
                <div class="side-menu__title">
                    Setting
                    <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('category.add') }}"
                        class="side-menu {{ request()->routeIs('category.*') ? 'side-menu--active side-menu--open' : ' ' }}">
                        <i class="fa-solid fa-square"></i><div class="side-menu__title">Add Block</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('road.add') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-road"></i><div class="side-menu__title">Add Road</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('plot.add') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-compass-drafting"></i><div class="side-menu__title">Add Plot</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.discount') }}" class="side-menu side-menu--active side-menu--open">
                        <i class="fa-solid fa-gears"></i><div class="side-menu__title">Payment Setting</div>
                    </a>
                </li>
            </ul>
        </li>
        <br>
        <li>
            <a href="{{ route('logout') }}" style="background: rgb(33, 65, 246)"
                class="border rounded dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"
                onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <i data-feather="toggle-right" class="w-4 h-4 me-2"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>