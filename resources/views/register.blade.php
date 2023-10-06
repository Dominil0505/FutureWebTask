@extends('layout')
@section('content')
    <div class="row align-iterms-center justify-content-center">
        <div class="col-sm-4">
            <form action="postRegister" method="POST">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Név</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email cím</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-check-label" for="">Van már felhasználód? <a href="/login" class="link-primary"> Jelentkezz be! </a></label>
                </div>
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </form>
        </div>
    </div>
@endsection
