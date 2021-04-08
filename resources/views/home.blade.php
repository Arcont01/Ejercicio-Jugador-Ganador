@extends('layouts.app')

@section('content')

<section class="container">
    <div class="row">
        <div class="col-12 mb-5">
            <form action="{{route('home.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Subir archivo</label>
                    <input type="file" name="file" id="file" class="form-control rounded-pill">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill">Enviar</button>
            </form>
        </div>
    </div>
</section>
@endsection
