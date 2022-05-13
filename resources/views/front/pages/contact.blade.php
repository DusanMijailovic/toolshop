@extends("layouts.front")

@section("title") Тool shop - Contact page @endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 mt-4">
                <div id="successMessage" class="alert invisible" role="alert">
                    <p class="text-center font-weight-light" id="msg"></p>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">

                            <label for="validationCustom01" class="lead">Ime i prezime</label>
                            <input type="text" class="form-control font-weight-light" id="fullName" name="fullName" placeholder="Uneti ime i prezime..."/>
                            <small id="fullNameHelp" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="validationCustom02" class="lead">Email</label>
                        <input type="text" class="form-control font-weight-light" id="email" name="email" placeholder="Uneti email..."/>
                        <small id="emailHelp" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label class="lead">Vaša poruka</label>
                    <textarea id="content" name="content" class="form-control font-weight-light"></textarea>
                    <small id="contentHelp" class="form-text text-danger"></small>
                </div>
                <button type="button" id="contactBtn" name="sendContact" value="Pošalji" class="btn bg-secondary text-white mt-4 mb-5 font-weight-light">Pošalji</button>

            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="{{ asset("js/contact.js") }}"></script>
@endsection
