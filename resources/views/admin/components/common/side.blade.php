<div id="wrapper">
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <span>Korisnik</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <span>Kategorije</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tools.index') }}">
                <span>Alat</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.index') }}">
                <span>Kontakt</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logs') }}">
                <span>Logovi</span></a>
        </li>

        <li class="nav-item">
            <a class="btn btn-light btn-block mx-auto btn-sm w-50" href="{{ route('logout') }}">
                Odjava
            </a>
        </li>
    </ul>




    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
