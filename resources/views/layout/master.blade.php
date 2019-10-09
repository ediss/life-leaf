<!DOCTYPE html>

<html lang="sr">

<head>

	<title>Life Leaf | Maja Vučković</title>
    <!-- includes -->
    @include('layout.header')
    <!-- end includes -->

    <!-- analytic -->
    @include('layout.analytic')
	<!-- end analytic -->

</head>


<body>
    @include('layout.navigation')
    
    <div class="container-fluid p-0">
        @yield('content')
    </div>
    
    @include('layout.footer')
</body>

</html>

