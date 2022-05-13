@extends("layouts.front")

@section("title") Тool shop - Cart page @endsection

@section('content')

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-10 ml-5">
                <div class="panel panel-info"  style="margin-top: 100px">
                    <!-- panel heading -->
                    <div class="panel-heading">
                        <!-- panel title -->
                        <div class="panel-title">
                            <!-- row -->
                            <div class="row">
                                <div class="col-lg-10">

                                    <ul class="list-inline mr-5">
                                        <li class="list-inline-item">
                                            <h6 class="text-right lead mr-3">Da li ste izabrali proizvode?</h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button"  class="btn btn-primary text-white my-3 font-weight-light" id="buyBtn">Kupite proizvode</button>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-xs-3" id="price">

                                    <h4 class="text-right  ml-3">Ukupno: <strong>{{ $sum }} din</strong></h4>

                                </div>
                            </div>
                            <!-- row -->
                            <hr>
                        </div>
                        <!-- panel title -->
                    </div>
                    <!-- panel heading -->

                    <div class="panel-body mt-5" id="tools1">

                        @foreach($cart as $c)
                        <div class="row" style="margin-left: 250px; " >
                            <div class="col-lg-3">
                                <img class="img-responsive" style="width: 200px; height: 200px; " src="{{ asset("/img/tools/{$c->imgSrc}") }}">
                            </div>

                            <div class="col-lg-5">

                                <h5 class="product-name mr-2">
                                    <strong>{{ $c->name }}</strong>
                                </h5>
                                <h5 class="mr-2">
                                    <small style="text-align: justify;">{{ $c->description }}</small>
                                </h5>
                            </div>
                           <div class="col-lg-2">


                               <h6> <del><strong class="ml-2 mt-4 text-danger">Cena: {{ $c->price }} dinara</strong> </del></h6><br>
                                   <h6><strong class="ml-2 mt-4 ">Cena na sajtu: {{ $c->sitePrice }} dinara</strong> </h6>
                           </div>

                            <a href="#" class="ml-5 deleteBtn" data-id="{{ $c->cartID }}"><i class="far fa-trash-alt fa-lg"></i></a>
                        </div>
                            <br>
                            @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        @endsection
 @section("script")
            <script src="{{ asset("js/cart.js") }}"></script>
     @endsection
