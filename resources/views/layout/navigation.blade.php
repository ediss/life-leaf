<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKGNL3L" height="0" width="0"
        style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="" href="index.php">
            <img src="{{ asset('images/life-leaf-belo.png') }}" class="logo img-fluid" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-toggle " id="navbarNavAltMarkup">
            <ul class="navbar-nav mx-auto">
                <li class = "nav-item">
                    <a class="nav-link text-uppercase" href="index.php">O Meni</a>
                </li>

                <li class = "nav-item">
                    <a class="nav-link text-uppercase" href="psihoterapija.php">Psihoterapija</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-uppercase dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Coaching
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu second" style="display: none;">
                        <a class="dropdown-item" href="o-coachingu.php">O coaching-u</a>
                        <a class="dropdown-item" href="life-coaching.php">Life Coaching</a>
                        <a class="dropdown-item" href="health-coaching.php">Health Coaching</a>
                        <a class="dropdown-item" href="business-coaching.php">Business Coaching</a>
                        <a class="dropdown-item" href="executive-coaching.php">Executive Coaching</a>
                    </div>

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-uppercase dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Radionice
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu second" style="display: none;">
                        <a class="dropdown-item" href="oli-psihodinamski-asertivni-trening.php">Psihodinamski asertivni
                            trening</a>
                        <a class="dropdown-item" href="asertivnost-partnerskim-odnosima.php">Asertivnost u partnerskim
                            odnosima</a>
                        <a class="dropdown-item" href="asertivnost-poslovnim-odnosima.php">Asertivnost u poslovnim
                            odnosima</a>
                        <a class="dropdown-item" href="raskrinkati-manipulaciju.php">Kako raskrinkati manipulaciju</a>
                        <a class="dropdown-item" href="manipulaciju-poslovnom-okruzenju.php">Manipulacija u poslovnom
                            okruženju</a>
                        <a class="dropdown-item" href="radionice-maja-vuckovic.php">Ostale radionice</a>
                    </div>
                </li>

                <li class = "nav-item">
                    <a class="nav-link text-uppercase" href="blog.php">Blog</a>
                </li>

                <li class = "nav-item">
                    <a class="nav-link text-uppercase" href="faq.php">FAQ</a>
                </li>

                <li class = "nav-item">
                    <a class="nav-link text-uppercase" href="kontakt.php">Kontakt</a>
                </li>

            </ul>
            <div class="col-lg-3 col-sm-6 w3l-footer footer-social-agile mt-lg-0 mt-4">
                <ul class="list-unstyled">
                    <li class="text-white mr-xl-4 mr-2 ml-xl-0 ml-lg-5">
                        <a href="tel:+381653519563">+381 65 35 19 563</a>
                    </li>

                    <li>
                        <select onchange="window.location.replace(this.options[this.selectedIndex].value); "
                            class="ml-3 transparentno zelenoo downn">
                            <option value="">SR</option>
                            <option value="">EN</option>
                        </select>
                    </li>



                </ul>

            </div>
            <ul class="navbar-nav ml-auto">

               <!-- Authentication Links -->
               @guest
               <li class="nav-item">
                   <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm" href="#">{{ __('Login') }}</a>
               </li>
               @if (Route::has('register'))
                   <li class="nav-item">
                       <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                   </li>
               @endif
           @else
               <li class="nav-item dropdown">
                   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                       {{ Auth::user()->name }} <span class="caret"></span>
                   </a>

                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="{{ route('user.logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                       </a>

                       <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </div>
               </li>
           @endguest
            </ul>
        </div>

    </nav>

</header>