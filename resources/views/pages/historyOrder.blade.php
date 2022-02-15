@extends('template.template')

@section('content')

    <h2>{{trans('History Order')}}</h2>

    <table class="table table-bordered mt-2">
        <thead class="thead-dark">
            <tr>
                <th>{{trans('Title')}}</th>
                <th>{{trans('Author')}}</th>
                <th>{{trans('Order Date')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->ebook->title}}</td>
                <td>{{$order->ebook->author}}</td>
                <td>{{$order->order_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
