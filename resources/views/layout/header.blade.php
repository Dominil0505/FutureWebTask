<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/users">FutureWeb Feladat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('users') }}">Felhasználók</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('posts') }}">Saját posztok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('comments') }}">Kommentek</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-5">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/logout">Kijelentkezés</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
