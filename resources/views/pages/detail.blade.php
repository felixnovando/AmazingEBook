@extends('template.template')
@section('content')

    <h2>E-Book Detail</h2>

    <h2>{{trans('Title')}}</h2>

    <p class="fs-4">{{$ebook->title}}</p>

    <h2>{{trans('Author')}}</h2>

    <p class="fs-4">{{$ebook->author}}</p>

    <h2>{{trans('Description')}}</h2>

    <p class="fs-5">{{$ebook->description}}</p>

    <form method="POST" action="{{url('/addCart')}}">
        @csrf
        <input type="hidden" name="id" value="{{$ebook->ebook_id}}">

        @if(is_null($cart))
            <button class="btn btn-success p-2 fs-4">{{trans('Rent')}}</button>
        @else
            <button disabled class="btn btn-warning p-2 fs-4">{{trans('Already In Cart')}}</button>
        @endif
    </form>

@endsection
