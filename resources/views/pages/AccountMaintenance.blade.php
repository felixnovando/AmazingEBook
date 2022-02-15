@extends('template.template')

@section('content')

    <table class="table table-bordered mt-2">
        <thead class="thead-dark">
        <tr>
            <th>{{trans('Account')}}</th>
            <th colspan="2">{{trans('Action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} - {{$user->role->role_desc}}</td>
                <td><a href="{{url('updateRole/' . $user->id)}}"><button class="btn btn-warning">{{trans('Update Role')}}</button></a></td>
                <td>
                    <form method="POST" action="{{url('delete-user')}}">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <button class="btn btn-danger">{{trans('Delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
