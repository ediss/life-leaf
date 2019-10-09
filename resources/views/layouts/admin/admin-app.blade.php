<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Life-Leaf</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <meta name="_token" content="{{ csrf_token() }}">

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta Tags -->

    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/css/mdb.css') }}" rel="stylesheet">
    <link href="{{asset('admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    {{-- <link href="{{asset('admin/css/datepicker.css')}}" rel="stylesheet" type="text/css" media="all" /> --}}

    <link href="{{ asset('admin/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- SELECT2 -->
    <link href="{{ asset('admin/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- SWEET-ALERT -->
    <link href="{{ asset('admin/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bars Css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bar.css') }}">
    <!--// Bars Css -->
    <!-- Calender Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pignose.calender.css') }}" />
    <!--// Calender Css -->
    <!-- Common Css -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Nav Css -->
    <link rel="stylesheet" href="{{ asset('admin/css/style4.css') }}">
    <!--// Nav Css -->
    <!-- Fontawesome Css -->
    <link href="{{ asset('admin/css/fontawesome-all.css') }}" rel="stylesheet">

    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->

</head>

<body>




    <div class="wrapper">

        <!-- Sidebar Holder -->
        @include('layouts.admin.inc.admin-nav', ['patients' => $patients_variable, 'access' => $access])

        <!-- Page Content Holder -->
        <div id="content">

            @include('layouts.admin.inc.admin-header', [ 'sessions_per_week' => $sessions_variable, 'patients' =>
            $patients_variable ])
            @if (Session::has('success-password-change'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{Session::get('success-password-change')}}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>


            <!-- Copyright -->
            <div class="copyright-w3layouts py-xl-3 py-2 mt-xl-5 mt-4 text-center">
                <p>© 2019 Life-Leaf . All Rights Reserved | Developed by
                    <a href="#"> Skenderi E.</a>
                </p>
            </div>
            <!--// Copyright -->
        </div>
    </div>

    <div class="modal fade" id="modalUpdatePassForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" action="{{ route('admin.password.update', ['id' => Auth::user()->id]) }}">
                    @csrf

                    <div class="form-group row">

                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <label for="new_password">Nova lozinka:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="new_password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-default">Sačuvaj</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- Required common Js -->
    <script src='{{ asset('admin/js/jquery-2.2.3.min.js') }}'></script>

    <!-- //Required common Js -->

    <!-- loading-gif Js -->
    <script src="{{ asset('admin/js/modernizr.js') }}"></script>


    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <!--// loading-gif Js -->

    <!-- Sidebar-nav Js -->
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!--// Sidebar-nav Js -->

    <!-- Graph -->
    <script src="{{ asset('admin/js/SimpleChart.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('admin/js/ajaxload.js') }}"></script>
    <script src="{{ asset('admin/js/pagination.js') }}"></script>

    <script src="{{ asset('admin/js/rumcaJS.js') }}"></script>
    <script src="{{ asset('admin/js/example.js')}}"></script>

    <script src="{{ asset('admin/js/moment.min.js') }}"></script>


    <script src="{{ asset('admin/js/script.js') }}"></script>

    <!-- dropdown nav -->
    <script>
        $(document).ready(function () {
            $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->

    <script src="{{ asset('admin/js/mdb.js') }}"></script>
    <!-- Js for bootstrap working-->

    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('admin/sweet-alert2/sweetalert2.min.js') }}"></script>


    <script>
        $(function () {
            AjaxLoad.initialize();
        });

        function reloadPage(){
            location.reload();
        }
    </script>

    <script>
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
        });
        
        $('.js-select2').select2({
            theme: 'bootstrap4',
            placeholder: '  -- Izaberite pacijenta --',
        });

        $('#search_by_selected_name').on("change", function (e) {

            var selected_val = this.value;
            var route = "{{ route('admin.patient.profile') }}/"+selected_val;
            
            $("#change_route a").attr("href", route);

        });
    </script>


    @yield('footer-js')
</body>

</html>