@extends('template.template')


@section('content')

    <table class="table table-bordered mt-2">
        <thead class="thead-dark">
            <tr>
                <th colspan="2">{{trans('Title')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
            <tr>
                <td>{{$cart->ebook->title}}</td>
                <td>
                    <form method="POST" action="{{url('delete-cart')}}">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="ebook_id" value="{{$cart->ebook_id}}">
                        <button class="btn btn-danger">{{trans('Delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{url('order')}}">
        @csrf
        <div>
            @if(count($carts) == 0)
                <button disabled class="btn btn-warning">{{trans('Submit')}}</button>
            @else
                <button class="btn btn-success">{{trans('Submit')}}</button>
            @endif
        </div>
    </form>

@endsection
