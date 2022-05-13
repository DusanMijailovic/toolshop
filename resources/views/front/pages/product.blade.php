@extends("layouts.front")

@section("title") Тool shop - Product page @endsection

@section('content')

    <div class="container" style="margin-top: 120px">

        <h1 id="title" class="my-5 text-uppercase font-weight-normal">{{$tool->tool}}</h1>
        <div class="row">
            <div class="col-md-5">
                <img id="picture" class="img-fluid picture mr-5" src="{{ asset("/img/tools/{$tool->imgSrc}") }}" >
            </div>
            <div class="col-md-6 ml-4">
                <p class="mb-5 lead">{{ $tool->description  }}</p>               <ul class="list-unstyled">
                    <hr>
                    <h3 class="mb-5 font-weight-normal">Detalji o proizvodu</h3>
                    <li class="float-sm-right">
                        <div id="successMessage" class="alert invisible t w-100"  role="alert"  style="height: 165px;">
                            <p class="text-center mt-5" id="msg"></p>
                        </div>
                    </li>

                    <li class="mt-4 lead">Cena: {{$tool->price}}  dinara</li>
                    <li class="mt-4 lead" >Cena na sajtu: <span id="price-site">{{$tool->sitePrice}} </span> dinara</li>
                    <li class="mt-4 lead text-success">Ušteda: {{$tool->price - $tool->sitePrice }}  dinara<i class="far fa-check-square fa-lg ml-2 text-success"></i></li>
                    @if(session()->has('user'))


                    <input id="categoryID" type="hidden" name ="category" value="{{$tool->ctID}}" />
                    <span>
              <button type="button" id="addToolBtn" class="btn bg-secondary text-white my-5 font-weight-light"><i class="mr-1 fas fa-shopping-cart"></i> Dodaj u korpu</button>
            </span>
                        @else
                        <h3 class="my-5 font-weight-light">Da biste mogli da kupite proizvod, morate biti prijavljeni!</h3>
                        @endif

                </ul>
            </div>
        </div>


    </div>

@endsection
