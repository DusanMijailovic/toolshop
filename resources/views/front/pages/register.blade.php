@extends("layouts.front")

@section("title") Тool shop - Register page @endsection

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 mt-5">
                 <div id="successMessage" class="alert invisible" role="alert">
                  <p class="text-center font-weight-light" id="msg"></p>
                </div>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="lead">Ime i prezime</label>
                        <input type="text" class="form-control font-weight-light" id="name" name="fullName" aria-describedby="emailHelp" placeholder="Unesite ime i prezime..." />
                        <small id="nameError" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="lead">Email adresa</label>
                        <input type="email" class="form-control font-weight-light" id="email" name="email" aria-describedby="emailHelp" placeholder="Unesite email..." />
                        <small id="emailError" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="lead">Lozinka</label>
                        <input type="password" class="form-control font-weight-light" id="password" name="password" aria-describedby="emailHelp" placeholder="Unesite lozinku...">
                        <small id="passwordError" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="lead">Potvrda lozinke</label>
                        <input type="password" class="form-control font-weight-light" id="confPass" name="confPass" placeholder="Potvrda lozinke">
                        <small id="confirmPasswordError" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label class="lead">Pol</label> <br>
                        <input type="radio"  name="gender" value="zenski"> <span  class="lead mr-2">Ženski</span>
                        <input type="radio"  name="gender" value="muski" > <span class="lead">Muski</span>
                        <small id="genderError" class="form-text text-danger"></small>
                    </div>
                    <button type="button" name="sendContact" id="registerBtn" value="Pošalji" class="btn bg-secondary text-white mt-4 mb-5 font-weight-light">Pošalji</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="{{ asset("js/register.js") }}"></script>
@endsection
