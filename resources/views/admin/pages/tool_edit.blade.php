@extends('layouts.admin')

@section('title')
    Edit tool - Admin panel
@endsection
@section('content')

   Izmena alata </div>
    <div class="container-fluid">

        <div class="card-body">
            <div class="table-responsive col-md-13">


                <form action="{{ url("/admin/tools/{$tool->toolID}")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-3 mb-3">

                        <input type="hidden" id="hdnToolID"  name="hdnToolID" value="{{ $tool->toolID }}"/>

                        <label>Tool name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $tool->tool }}">

                        <label>Tool description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $tool->description }}">

                        <label>Tool price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ $tool->price }}">

                        <label>Tool site price</label>
                        <input type="text" class="form-control" id="priceSite" name="sitePrice" value="{{ $tool->sitePrice }}">

                        <label>Tool category</label>
                        <select name="categoryId" class="form-control" id="selectCategory">
                            <option value="0">Select category</option>
                            @foreach($categories as $category)
                                @if($tool->categoryID ==$category->categoryID )
                                <option selected value="{{ $category->categoryID }}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->categoryID }}">{{ $category->name }}</option>

                                @endif
                            @endforeach
                        </select>

                        <label>Tool photo</label>
                        <input type="file" class="form-control" id="image"  name="imgSrc">
                        <img class="admin-img" src="{{ asset("/img/tools/{$tool->imgSrc}") }}" >

                        <button class="btn btn-primary my-3 update-tool" type="submit">Update</button>


                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('error'))
                    {{ session()->get('error') }}
                @endif



            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>


    </div>
    </div>


@endsection
