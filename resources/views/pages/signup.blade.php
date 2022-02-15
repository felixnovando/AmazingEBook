
@extends('template.template')

@section('content')


    <form method="POST" target="{{url('/signup')}}" enctype="multipart/form-data" class="d-flex h-100 flex-column justify-content-evenly align-items-center">
        @csrf
        <h2>{{trans('Sign Up')}}</h2>
        <div>
            <label for="first_name" class="fs-6">{{trans('First Name')}}</label>
            <input type="text" name="first_name" id="first_name" class="fs-6">
        </div>
        <div>
            <label for="middle_name" class="fs-6">{{trans('Middle Name')}}</label>
            <input type="text" name="middle_name" id="middle_name" class="fs-6">
        </div>
        <div>
            <label for="last_name" class="fs-6">{{trans('Last Name')}}</label>
            <input type="text" name="last_name" id="last_name" class="fs-6">
        </div>
        <div>
            <label for="email" class="fs-6">{{trans('Email Address')}}</label>
            <input type="text" name="email" id="email" class="fs-6">
        </div>
        <div>
            <label for="" class="fs-6">{{trans('Gender')}}</label>
            <input type="radio" name="gender" id="male" value="male" class="fs-6">
            <label for="male" class="fs-6">{{trans('Male')}}</label>
            <input type="radio" name="gender" id="female" value="female" class="fs-6">
            <label for="female" class="fs-6">{{trans('Female')}}</label>
        </div>
        <div>
            <label for="role" class="fs-6">{{trans('Role')}}</label>
            <select name="role_id">
                @foreach($roles as $role)
                    <option value="{{$role->role_id}}">{{$role->role_desc}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="password" class="fs-6">{{trans('Password')}}</label>
            <input type="password" name="password" id="password" class="fs-6">
        </div>
        <div>
            <label for="picture" class="fs-6">{{trans('Display Picture')}}</label>
            <input type="file" name="picture" id="picture" class="fs-6">
        </div>
        <div>
            @if($errors->any())
                <p class="text-danger">{{$errors->first()}}</p>
            @endif
        </div>
        <div>
            <button class="btn btn-primary fs-6">{{trans('Submit')}}</button>
        </div>
        <a href="{{url('/login')}}" class="fs-6">{{trans('Already have an account? click here to log in')}}</a>
    </form>

@endsection
