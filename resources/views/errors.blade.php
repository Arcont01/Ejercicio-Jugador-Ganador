@extends('layouts.app')

@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                @isset($errors)
                <div class="text-danger">
                    <p>{{$errors->first('file')}}</p>
                </div>
                @endisset
                @isset($error_requirements)
                <div class="text-danger">
                    <p>{{$error_requirements}}</p>
                </div>
                @endisset
            </div>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary btn-block rounded-pill" href="{{route('home.index')}}">Volver a intentar</a>
        </div>
    </div>
</section>
@endsection
