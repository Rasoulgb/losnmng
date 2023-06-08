<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        datalist {
            display: flex;
            flex-direction: column;

            writing-mode: vertical-lr;

        }
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          rel="stylesheet" crossorigin="anonymous" />

    {{--
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <style>
        #ex1RangePicker .rangepicker-selection {
            background: #BABABA;
        }
    </style>
    <title>@yield('title','Loan') </title>
    @livewireStyles
</head>

<body>

    <ul class="nav nav-pills  justify-content-center">
        @auth
        <li class="nav-item ">
            <a class="nav-link    {{ (Request::segment(1)=='loan' and Request::segment(3)!='create') ? 'active' : ''}}"
               href="{{ route('loan.index') }} ">Loan
                List</a>
        </li>
        <li class="nav-item">

            @if ( !auth()->user()->isAdmin())
            <a class="nav-link  {{ (Request::segment(3)=='create' or (Request::segment(1)=='user' and Request::segment(2)=='' )) ? 'active' : ''}}"
               href="{{ route('loan.create',auth()->user()->id) }}">Create Loan</a>
            @else
            <a class="nav-link    {{ (Request::segment(2)=='create' or (Request::segment(1)=='user' and Request::segment(2)=='' )) ? 'active' : ''}}"
               href="{{ route('user.index') }}">User
                List</a>
            @endif

        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::segment(2)!=null and Request::segment(1)=='user' and Request::segment(3)==null) ? 'active':'' }}"
               href="{{ route('user.profile',auth()->user()->name) }}">Profile</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{(Request::segment(3)=='report' and Request::segment(1)=='user') ? 'active':'' }}"
               href="{{ route('loan.report',auth()->user()->name) }}">Report</a>
        </li>

        <li class="nav-item pt-2">
            <form action="{{ route('logout') }}" method="post" id='logout'>
                @csrf
                @method('post')
                <a onclick="document.getElementById('logout').submit(); "
                
                   data-toggle="tooltip" title="LogOut"
                   href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-power"
                         viewBox="0 0 16 16">
                        <path d="M7.5 1v7h1V1h-1z" />
                        <path
                              d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                    </svg>
                </a>
            </form>
        </li>

        @endauth
    </ul>


    <!-- header -->

    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('loan.index') }}">Loan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            </div>
        </div>
        </div>
    </nav> --}}

    <header class="masthead bg-primary text-white text-center py-4">
        <div class="container d-flex align-items-center flex-column">
            <h2>@yield('subtitle')</h2>
        </div>
    </header>
    <!-- header -->
    <div class="container my-4">
        @yield('content')
    </div>
    <!-- footer -->
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>
                Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
                   href="https://twitter.com/danielgarax">
                    Daniel Correa
                </a> - <b>Paola Vallejo</b>
            </small>
        </div>
    </div>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>