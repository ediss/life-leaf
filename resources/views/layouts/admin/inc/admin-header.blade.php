<!-- top-bar -->
<nav class="navbar navbar-default mb-xl-5 mb-4">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Search-div -->
        <div class="search-form ajax-form form-patients col-md-6">

            <div class="row">
                <div class="col-md-8 text-center">
                    <select class="form-control js-select2 text-center" name="search_by_selected_name" id = "search_by_selected_name">
                        <option value="">--Izaberite Pacijenta--</option>
                        @foreach ($patients->get() as $patient)
                            <option value="{{ $patient->id }}"> {{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class = "col-md-4 text-left" id = "change_route">
                        <a class=" btn btn-primary my-2 my-sm-0" href="" target="_blank">Pronađi</a>
                    </div>
            </div>
            
                
          
        </div>

        <!--// Search-div -->
        <ul class="top-icons-agileits-w3layouts float-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge">4</span>
                </a>
                <div class="dropdown-menu top-grid-scroll drop-1">
                    <h3 class="sub-title-w3-agileits">Obaveštenja</h3>
                    {{-- <a href="#" class="dropdown-item mt-3">
                        <div class="notif-img-agileinfo">
                            <img src="{{ asset('admin/images/clone.jpg')}}" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="notif-content-wthree">
                            <p class="paragraph-agileits-w3layouts py-2">
                                <span class="text-diff">John Doe</span> Curabitur non nulla sit amet nisl tempus
                                convallis quis ac lectus.</p>
                            <h6>4 mins ago</h6>
                        </div>
                    </a> --}}
        
             
            
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Not implemented</a>
                </div>
            </li>
            <li class="nav-item dropdown mx-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-spinner"></i>
                </a>
                <div class="dropdown-menu top-grid-scroll drop-2">
                    <h3 class="sub-title-w3-agileits"> Prečice </h3>
                    <a href="#" class="dropdown-item mt-3">

                    <p> <b>Sesije</b></p> <br>

                    <h4>
                        {{\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY)->format('D jS')}}
                        - {{\Carbon\Carbon::now()->format('D jS')}} <br><br>
                        <b>Ukupno sesija : {{$sessions_per_week}}</b>
                    </h4>
                    
                    </a>
                    <hr>
                    <a href="{{ route('admin.show.statistic', ['tab_name' => 'nav-patients-tab']) }}" class="dropdown-item">
                        <h4><i class="fas fa-eye mr-3"></i> Prikaz pacijenata </h4>
                    </a>

                    <a href="{{ route('admin.show.statistic', ['tab_name' => 'nav-sessions-tab']) }}" class="dropdown-item">
                            <h4><i class="fas fa-eye mr-3"></i> Prikaz sesija </h4>
                        </a>
                    <hr>
                    <a href="{{ route('admin.insert.patient') }}" class="dropdown-item">
                        <h4><i class="fas fa-user-plus mr-3"></i> Dodaj pacijenta </h4>
                    </a>
                    <a href="{{ route('admin.insert.session') }}" class="dropdown-item mt-3">
                        <h4><i class="fab fa-superpowers mr-3"></i> Dodaj sesiju</h4>
                    </a>
                    
                    <hr>

                    <a href="#" data-toggle="modal" data-target="#modalUpdatePassForm" class="dropdown-item mt-3">
                        <h4><i class="fas fa-wrench mr-3"></i> Promeni lozinku</h4>
                    </a>
                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu drop-3">
                    <div class="profile d-flex mr-o">
                        <div class="profile-l align-self-center">
                            <img src="{{ asset('images/maja-vuckovic-online.jpg')}}" class="img-fluid mb-3"
                                alt="Responsive image">
                        </div>
                        <div class="profile-r align-self-center">
                            <h3 class="sub-title-w3-agileits">{{ Auth::user()->name }}</h3>
                            <a href="mailto:info@example.com">{{ Auth::user()->email }}</a>
                        </div>
                    </div>
                    <hr>
                    <span >not implemented</span>
                    <a href="#" class="dropdown-item mt-3">
                        <h4>
                            <i class="far fa-user mr-3"></i>My Profile </h4>
                    </a>
                    <a href="#" class="dropdown-item mt-3">
                        <h4>
                            <i class="fas fa-link mr-3"></i>Activity</h4>
                    </a>
                    <a href="#" class="dropdown-item mt-3">
                        <h4>
                            <i class="far fa-envelope mr-3"></i>Messages</h4>
                    </a>
               
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                        {{ __('Logout') }}
                    </a>
                    

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none" >
                        @csrf
                        <input type="submit">
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--// top-bar -->