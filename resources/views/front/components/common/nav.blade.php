<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset("img/logo.png") }}" alt="t-house logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                @foreach($menu as $m)

                    <li class="nav-item active lead">

                        <a class="nav-link" href="{{ url($m->href) }}">{{ $m->name }}

                        </a>
                    </li>


                @endforeach
                @if(session()->has('user'))
                        <li class="nav-item">
                            <a class="nav-link border lead" href="{{ route('logout') }}">Logout</a>
                        </li>
                        <li class="mt-2">
                            <input type="hidden" id="userID" value="  session()->has('user')->userID  ">

                                <li class="nav-item ml-1 mt-1">
                                     <a class="nav-link cartNumber" href="{{ route('cart') }}"><i class="fas fa-shopping-cart">({{ $cartNumber }})</i></a>
                                </li>

                        </li>
                    @else

                <li class="nav-item">
                    <a class="nav-link border lead" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link border lead" href="{{ route('register') }}">Registration</a>
                </li>
                {{--<li class="nav-item ml-1 mt-1">
                    <a class="nav-link" href="{{ route('cart') }}"><i class="fas fa-shopping-cart">(0)</i></a>
                </li>--}}
                    @endif
            </ul>
        </div>
    </div>
</nav>


