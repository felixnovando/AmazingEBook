@extends('template.template')

@section('content')

    <table class="table table-bordered mt-2">
        <thead class="thead-dark">
            <tr>
                <th>{{trans('Author')}}</th>
                <th>{{trans('Title')}}</th>
                <th>{{trans('Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ebooks as $ebook)
            <tr>
                <td>{{$ebook->author}}</td>
                <td>{{$ebook->title}}</td>
                <td><a href="{{url('detail/' . $ebook->ebook_id)}}"><button class="btn btn-success">{{trans('View')}}</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
