
@extends('template.template')

@section('content')

    <form method="POST" action="{{url('/updateProfile')}}" enctype="multipart/form-data" class="d-flex align-items-center justify-content-start ps-5 ms-5" style="height: 95%">
        @method('put')
        @csrf
        <div>
            @if(strcmp(\Illuminate\Support\Facades\Auth::user()->display_picture_link, "") != 0)
                <img class="me-5" style="width: 250px; height: 250px; object-fit: cover" src="{{\Illuminate\Support\Facades\URL::asset(\Illuminate\Support\Facades\Auth::user()->display_picture_link)}}">
            @else
                <img style="width: 250px; height: 250px; object-fit: cover" src="{{asset("blank_profile.png")}}">
            @endif
        </div>
        <div class="d-flex h-100 flex-column justify-content-evenly align-items-center">
            <div>
                <label for="first_name">{{trans('First Name')}}</label>
                <input type="text" name="first_name" id="first_name" value="{{\Illuminate\Support\Facades\Auth::user()->first_name}}">
            </div>
            <div>
                <label for="middle_name">{{trans('Middle Name')}}</label>
                <input type="text" name="middle_name" id="middle_name" value="{{\Illuminate\Support\Facades\Auth::user()->middle_name}}">
            </div>
            <div>
                <label for="last_name">{{trans('Last Name')}}</label>
                <input type="text" name="last_name" id="last_name" value="{{\Illuminate\Support\Facades\Auth::user()->last_name}}">
            </div>
            <div>
                <label for="email">{{trans('Email Address')}}</label>
                <input type="text" name="email" id="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
            </div>
            <div>
                <label for="">{{trans('Gender')}}</label>
                @if(strcmp(\Illuminate\Support\Facades\Auth::user()->gender->gender_desc, "Male"))
                    <input type="radio" name="gender" id="male" value="male" checked>
                @else
                    <input type="radio" name="gender" id="male" value="male">
                @endif
                    <label for="male">{{trans('Male')}}</label>
                @if(strcmp(\Illuminate\Support\Facades\Auth::user()->gender->gender_desc, "Female"))
                    <input type="radio" name="gender" id="female" value="female" checked>
                @else
                    <input type="radio" name="gender" id="female" value="female">
                @endif
                    <label for="female">{{trans('Female')}}</label>
            </div>
            <div>
                <label for="role">{{trans('Role')}}</label>
                <select name="role_id" disabled>
                    @foreach($roles as $role)
                        @if(\Illuminate\Support\Facades\Auth::user()->role_id == $role->role_id)
                            <option value="{{$role->role_id}}" selected>{{$role->role_desc}}</option>
                        @else
                            <option value="{{$role->role_id}}">{{$role->role_desc}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="password">{{trans('Password')}}</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="picture">{{trans('Display Picture')}}</label>
                <input type="file" name="picture" id="picture">
            </div>
            <div>
                @if($errors->any())
                    <p class="text-danger">{{$errors->first()}}</p>
                @endif
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{trans('Submit')}}</button>
            </div>
        </div>
    </form>

@endsection
