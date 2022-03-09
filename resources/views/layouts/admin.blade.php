<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Marine Debris Tracker') }}</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    @toastr_css
</head>

<body>
    <div class="page-loader" id="page-loader" >
        <img src="/assets/images/fading_balls.gif" class="m-auto" />
      </div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h5>Marine Debris Tracker</h5>
            </div>

            <ul class="list-unstyled components">
                <li class={{ (request()->is('home')) ? 'active' : '' }}>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li class={{ (request()->is('users*')) ? 'active' : '' }}>
                    <a href="{{route('users.index')}}">Users</a>
                </li>
                <li class={{ (request()->is('user-ranking*')) ? 'active' : '' }}>
                    <a href="{{route('user-ranking.index')}}">User Ranking</a>
                </li>
                <li class={{ (request()->is('admin*')) ? 'active' : '' }}>
                    <a href="{{route('admin.index')}}">Admins</a>
                </li>
                <li class={{ (request()->is('location-bases-collection*')) ? 'active' : '' }}>
                    <a href="{{route('location-bases-collection.index')}}">Location Based Collections</a>
                </li>
                <li class={{ (request()->is('zones*')) ? 'active' : '' }}>
                    <a href="{{route('zones.index')}}">Zones</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                        {{-- <span>Toggle Sidebar</span> --}}
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="{{route('profile.index')}}" class="btn btn-md btn-warning mr-1 mb-2 mt-1"><i class="fas fa-user-circle"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <button  onclick="logout()" class="btn btn-md btn-secondary mr-1 mb-2 mt-1"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @jquery
    @toastr_js
    @toastr_render

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <script>
        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                html: "You want to logout" ,
                showCancelButton: true,
                confirmButtonColor: '#274D6C',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                $('#logout-form').submit();
                }
            })
        }
    </script>

    <script>
        $(window).on('load', function() {
            setTimeout(function(){ $('.page-loader').fadeOut('slow'); }, 1000);
        });
    </script>
    @stack('scripts')
</body>

</html>
