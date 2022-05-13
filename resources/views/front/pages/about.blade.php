@extends("layouts.front")

@section("title") Тool shop - About page @endsection

@section('content')
    <div class="container" style="margin-top: 100px">
        <h1 class="my-5 font-weight-normal">Informacije o autoru</h1>
        <div class="row">
            <div class="col-md-7">
                <img class="img-fluid img-thumbnail h-75" src="{{ asset("img/about.jpg") }}" alt="author">
            </div>
            <div class="col-md-5">
                <h3 class="my-3">Ime i Prezime</h3>
                <p>Dušan Mijailović</p>
                <h3 class="my-3">Broj indeksa</h3>
                <p>85/17</p>
                <hr>
                <p>Zdravo, zovem se Dušan Mijailović i živim u Beogradu. Trenutno sam završna godina Visoke ICT škole, smer Internet tehnologije.</p>

            </div>
        </div>
    </div>

@endsection
