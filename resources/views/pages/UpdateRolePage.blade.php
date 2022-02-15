@extends('template.template')


@section('content')

    <div class="h-75 d-flex justify-content-center flex-column">
        <form method="POST" action="{{url('/updateRole')}}" class="d-flex flex-column h-50 justify-content-evenly">
            @method('patch')
            @csrf
            <h1 class="fs-1">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</h1>

            <input type="hidden" name="id" value="{{$user->id}}">
            <div>
                <label for="role" class="fs-4">{{trans('Role')}}</label>
                <select name="role_id" class="w-25 fs-4">
                    @foreach($roles as $role)
                        @if($user->role_id == $role->role_id)
                            <option value="{{$role->role_id}}" selected>{{$role->role_desc}}</option>
                        @else
                            <option value="{{$role->role_id}}">{{$role->role_desc}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                @if($errors->any())
                    <p class="fs-4 text-danger">{{$errors->first()}}</p>
                @endif
            </div>
            <div>
                <button class="btn btn-success fs-4">{{trans('Save')}}</button>
            </div>
        </form>
    </div>

@endsection
