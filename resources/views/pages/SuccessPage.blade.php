@extends('template.template')

@section('content')

    <div class="d-flex flex-column justify-content-center align-items-center fs-1 h-100">
        <p>{{$message}}</p>

        @if(\Illuminate\Support\Facades\Auth::check())
            <a href="{{url('/home')}}">{{trans('Click Here To Home')}}</a>
        @else
            <a href="{{url('/')}}">{{trans('Click Here To Home')}}</a>
        @endif
    </div>

@endsection
