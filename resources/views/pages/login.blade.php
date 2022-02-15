@extends('template.template')

@section('content')

    <form method="POST" action="{{url('/login')}}" class="d-flex h-100 flex-column justify-content-evenly align-items-center">
        <h2>{{trans('Log In')}}</h2>
        @csrf
        <div>
            <label for="email" class="fs-4">{{trans('Email Address')}}</label>
        </div>
        <div>
            <input type="text" name="email" id="email" class="fs-4" style="width: 35vw">
        </div>
        <div>
            <label for="password" class="fs-4">{{trans('Password')}}</label>
        </div>
        <div>
            <input type="password" name="password" id="password" class="fs-4" style="width: 35vw">
        </div>
        <div>
            <button class="btn btn-primary fs-4">Submit</button>
        </div>
        <div>
            @if($errors->any())
                <p class="text-danger fs-4">{{$errors->first()}}</p>
            @endif
        </div>
        <a href="{{url('/signup')}}" class="fs-5">{{trans("Don't have an account? click here to sign up")}}</a>
    </form>

@endsection
