@extends('layout')
@section('content')
    <div class="row">
        <div class="col-sm-4">
            <form>
                <div class="mb-3">
                    <label for="" class="form-label">Név</label>
                    <input type="text" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email cím</label>
                    <input type="email" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jelszó újra</label>
                    <input type="password" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
