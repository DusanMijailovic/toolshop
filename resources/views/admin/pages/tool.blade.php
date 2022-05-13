@extends('layouts.admin')

@section('title')
    Tools - Admin panel
@endsection

@section('content')
    <i class="fas fa-table"></i>
    Alati Tabela
    <div class="container-fluid">

        <div class="card-body">
            <div class="table-responsive col-md-13">
                <table class="table">
                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Price Site</th>
                    <th>Image</th>
                    <th>Action</th>
                    </thead>
                    <tbody class="tool-table">
                    @foreach($tools as $tool)

                    <tr>
                        <td>{{ $tool->toolID }}</td>
                        <td>{{ $tool->name }}</td>
                        <td>{{ Str::limit($tool->description, 100) }}</td>
                        <td>{{ $tool->price }} dinara</td>
                        <td>{{ $tool->sitePrice }} dinara</td>
                        <td><img class="admin-img" src="{{ asset("/img/tools/{$tool->imgSrc}") }}" ></td>
                        <td>

                            <button class="btn btn-danger delete-tool" data-id="{{ $tool->toolID }}">Delete</button>
                        {{--<td><button class="btn btn-danger edit-tool" data-id="{{ $tool->toolID }}">Edit</button></td>--}}
                        <td><a href='/admin/tools/{{ $tool->toolID }}/edit' class='btn btn-danger edit-tool' data-id='{{ $tool->toolID }}'>Edit</a> </td>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>


                <form action="{{ route('tools.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="col-md-3 mb-3">

                    <input type="hidden" id="hdnToolID" />

                    <label>Tool name</label>
                    <input type="text" class="form-control" id="name" name="name">

                    <label>Tool description</label>
                    <input type="text" class="form-control" id="description" name="description">

                    <label>Tool price</label>
                    <input type="text" class="form-control" id="price" name="price">

                    <label>Tool site price</label>
                    <input type="text" class="form-control" id="priceSite" name="sitePrice">

                    <label>Tool category</label>
                    <select name="categoryId" class="form-control" id="selectCategory">
                        <option value="0">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <label>Tool photo</label>
                    <input type="file" class="form-control" id="image"  name="imgSrc">


                    {{-- <label>Tool src</label>
                     <input type="text" class="form-control" id="imgSrc">

                     <label>Tool alt</label>
                     <input type="text" class="form-control" id="imgAlt">--}}

                    <button class="btn btn-primary my-3 insert-tool" type="submit">Insert</button>


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


               {{-- <div class="pull-left">
                <form action="{{ route('tools.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3 mb-3">

                        <input type="hidden" id="hdnToolID1" />

                        <label>Tool name</label>
                        <input type="text" class="form-control" id="name1" name="name1">

                        <label>Tool description</label>
                        <input type="text" class="form-control" id="description1" name="description1">

                        <label>Tool price</label>
                        <input type="text" class="form-control" id="price1" name="price1">

                        <label>Tool site price</label>
                        <input type="text" class="form-control" id="priceSite1" name="sitePrice1">

                        <label>Tool category</label>
                        <select name="categoryId1" class="form-control" id="selectCategory1">
                            <option value="0">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <label>Tool photo</label>
                        <input type="file" class="form-control" id="image1"  name="imgSrc1">


                        <button class="btn btn-primary my-3 update-tool">Update</button>
                    </div>
                </form>

                </div>--}}

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

