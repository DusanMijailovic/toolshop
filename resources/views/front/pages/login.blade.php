@extends("layouts.front")

@section("title") Тool shop - Login page @endsection

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 mt-5">
                <!-- <div class="alert alert-warning mt-3 font-weight-light" role="alert">
                    <p class="text-center font-weight-light" id="msg"></p>
                </div> -->
                @if (session('error'))
                    <div class="alert alert-warning font-weight-light">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route("dologin") }}"  onsubmit="return login();">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="lead">Email adresa</label>
                        <input type="text" class="form-control font-weight-light" id="email" name="email" aria-describedby="emailHelp" placeholder="Uneti email...">
                        <small id="emailError" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password" class="lead">Lozinka</label>
                        <input type="password" class="form-control font-weight-light" id="password" name="password" placeholder="Uneti lozinku...">
                        <small id="passwordError" class="form-text text-danger"></small>
                    </div>
                    <input type="submit" id="loginBtn" name="loginBtn" class="btn bg-secondary text-white mt-4 mb-5 font-weight-light" value="Prijava">
            </div>
        </div>
        </form>

    </div>

@endsection

@section("script")
    <script src="{{ asset("js/login.js") }}"></script>
@endsection
