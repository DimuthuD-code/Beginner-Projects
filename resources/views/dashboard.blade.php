<!DOCTYPE html>
<html>
<head>
    <title>School Management System in Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
</head>
<body>

    @guest

    <h1 class="mt-4 mb-5 text-center">School Management System</h1>

    @yield('content')

    @else

    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('icons/css/all.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <button class="navbar-toggler position-absolute d-md-none d-left collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand col-md-3 ms-5 px-3" href="#">School Management System</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Welcome, {{ Auth::user()->email }}</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}" aria-current="page" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'profile' ? 'active' : '' }}" aria-current="page" href="/profile">Profile</a>
                        </li>
                        @if(Auth::user()->type == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'teachers' ? 'active' : '' }}" aria-current="page" href="/teachers">Teachers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'province' ? 'active' : '' }}" aria-current="page" href="/province">Province</a>
                        </li>        
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'course' ? 'active' : '' }}" aria-current="page" href="/course">Course</a>
                        </li>        
                        @endif
                        
                        @if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Teacher')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'students' ? 'active' : '' }}" aria-current="page" href="/students">Students</a>
                        </li>
                        @endif
                        @if(Auth::user()->type == 'Student')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'select_course' ? 'active' : '' }}" aria-current="page" href="/select_course">Courses</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>

                    </ul>

                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">!-->

                @yield('content')

                <!--</div>!-->
            </main>
        </div>
    </div>    

    @endguest

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>