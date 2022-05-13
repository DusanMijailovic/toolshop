<footer class="py-5 navbar-light bg-light border-top">
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <div class=" mr-auto mb-3">
                <ul class="list-inline">
                    <li>
                        @foreach($menu as $m)
                        <a class="list-inline-item text-dark text-decoration-none lead" href="{{ url($m->href) }}">{{ $m->name }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="mx-2 p-2 bd-highlight">
                @foreach($network as $net)
                <a href="{{ $net->link }}" class="text-dark hover-icon  mr-4 float-righ text-decoration-none"><i class="{{ $net->icon }}"></i></a>
                @endforeach
            </div>
        </div>
        <p class="m-0 text-center text-dark">Copyright &copy; Dušan Mijailović 2022</p>
    </div>
    <!-- /.container -->
</footer>
