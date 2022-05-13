<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="{{ route('product', ['id' => $tool->toolID]) }}"><img class="card-img-top" src="{{url($tool->imgSrc)}}" ></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('product', ['id' => $tool->toolID]) }}" class="text-decoration-none text-muted font-weight-normal">{{$tool->name}}</a>
            </h4>
            <h5>{{$tool->price}} dinara</h5>
            <p class="card-text">{{Str::limit($tool->description, 150) }} </p>
        </div>
        <div class="card-footer">
            <a class="btn bg-secondary text-white font-weight-light" href="{{ route('product', ['id' => $tool->toolID]) }}" role="button">Detaljnije</a>
        </div>
    </div>

</div>
