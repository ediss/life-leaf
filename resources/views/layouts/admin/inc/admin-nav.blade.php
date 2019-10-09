<nav id="sidebar">
    <div class="sidebar-header">
        <h1>
            <img src="{{ asset('images/life-leaf-belo.png') }}" class="logo img-fluid" alt="">
        </h1>
        <span></span>
    </div>
    <div class="profile-bg"></div>
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#">
                <i class="fas fa-th-large"></i>
                Dashboard
            </a>
        </li>

        <li>
            
            @if($access)
            <a href="#patientsSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-users"></i>
                Pacijenti ({{ $patients->count() }})
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>

            <ul class="collapse list-unstyled" id="patientsSubmenu">
                <li> <a href="{{ route('admin.insert.patient') }}"><i class="fa fa-angle-right"></i> Unos pacijenta</a>
                </li>
                <li> <a href="{{ route('admin.insert.session') }}"><i class="fa fa-angle-right"></i> Unos sesije</a>
                </li>
                <li> <a href="{{ route('admin.show.statistic') }}"><i class="fa fa-angle-right"></i> Statistika</a></li>
            </ul>
            @endif
            
            <a href="#coursesSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-laptop"></i>
                Kursevi
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="coursesSubmenu">
                <li>
                    <a href="{{ route('admin.insert.tutorial') }}"><i class="fa fa-angle-right"></i> Unos kursa</a>
                </li>
                {{-- <li>
                        <a href="carousels.html">Carousels</a>
                    </li>
                    <li>
                        <a href="forms.html">Forms</a>
                    </li>
                    <li>
                        <a href="modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="tables.html">Tables</a>
                    </li> --}}
            </ul>
        </li>

        {{-- <li>
                <a href="charts.html">
                    <i class="fas fa-chart-pie"></i>
                    Charts
                </a>
            </li>
            <li>
                <a href="grids.html">
                    <i class="fas fa-th"></i>
                    Grid Layouts
                </a>
            </li>
            <li>
                <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false">
                    <i class="far fa-file"></i>
                    Pages
                    <i class="fas fa-angle-down fa-pull-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu1">
                    <li>
                        <a href="404.html">404</a>
                    </li>
                    <li>
                        <a href="500.html">500</a>
                    </li>
                    <li>
                        <a href="blank.html">Blank</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="mailbox.html">
                    <i class="far fa-envelope"></i>
                    Mailbox
                    <span class="badge badge-secondary float-md-right bg-danger">5 New</span>
                </a>
            </li>
            <li>
                <a href="widgets.html">
                    <i class="far fa-window-restore"></i>
                    Widgets
                </a>
            </li>
            <li>
                <a href="pricing.html">
                    <i class="fas fa-table"></i>
                    Pricing Tables
                </a>
            </li>
            <li>
                <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    User
                    <i class="fas fa-angle-down fa-pull-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu3">
                    <li>
                        <a href="login.html">Login</a>
                    </li>
                    <li>
                        <a href="register.html">Register</a>
                    </li>
                    <li>
                        <a href="forgot.html">Forgot password</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="maps.html">
                    <i class="far fa-map"></i>
                    Maps
                </a>
            </li> --}}
    </ul>
</nav>