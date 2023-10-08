@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-4">
                <form action="postLogin" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email cím</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                    <div class="mb-3">
                        <label class="form-check-label">Nincs még felhasználód? <a href="register"
                                class="link-primary"> Regisztrálj </a></label>
                    </div>
                </form>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('email'))
                <div class="alert alert-success">
                    {{ session('email') }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
