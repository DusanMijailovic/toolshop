@extends("layouts.front")

@section("title")
    Tool Shop NON STOP
    @endsection

@section("content")

    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('{{ asset('img/slider1.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                        {{--<h2 class="display-4">First Slide</h2>
                        <p class="lead">This is a description for the first slide.</p>--}}
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('{{ asset('img/slider2.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                       {{-- <h2 class="display-4">Second Slide</h2>
                        <p class="lead">This is a description for the second slide.</p>--}}
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('{{ asset('img/slider3.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                        {{--<h2 class="display-4">Third Slide</h2>
                        <p class="lead">This is a description for the third slide.</p>--}}
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <div class="container-fluid mt-5">


        <div class="row">



            <div class="col-lg-3  my-5">

                <!-- Search form -->
                <form class="form-inline d-flex justify-content-center md-form form-sm">
                    <input id="search" class="form-control control-form form-control-sm w-75 font-weight-light" type="text" placeholder="Search"
                           aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </form>
                <h1 class="my-5 font-weight-normal">Kategorije</h1>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item nav-link lead">

                        <a href="#" id = "allTools" class=" text-decoration-none  text-muted category">Svi proizvodi</a>
                    </li>
                @foreach($categories as $cat)

                    @component("front.components.category", ['cat' => $cat])
                   @endcomponent

                    @endforeach
                </ul>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-8">


                <div class="row" id="tools">
                    {{--@foreach($tools as $tool)
                        @component('front.components.products', ['tool' => $tool])
                        @endcomponent

                    @endforeach--}}


                </div>
                <!-- /.row -->
                <div class="dataTables_paginate paging_simple_numbers " id="tools_paginate">
                    {{--{{ $tools->links() }}--}}
                </div>

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    @endsection
