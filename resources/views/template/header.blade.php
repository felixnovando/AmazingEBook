<div class="bg-primary position-sticky top-0 pt-2">
    <div class="d-flex align-items-center justify-content-center">
        <h1 class="text-white text-center">Amazing E-Book</h1>

        <div class="ms-5 d-flex justify-content-between align-items-center" style="width: 150px">
            @if (\Illuminate\Support\Facades\Auth::check() == false)
                <a class="text-white text-decoration-none fs-5" href="{{ url('/signup') }}">{{ trans('Sign Up') }}</a>
                <a class="text-white text-decoration-none fs-5" href="{{ url('/login') }}">{{ trans('Log In') }}</a>
            @else
                <a class="text-white text-decoration-none fs-5" href="{{ url('/logout') }}">{{ trans('Log Out') }}</a>
            @endif
        </div>

        @if (\Illuminate\Support\Facades\Auth::check())

            @php
                $user = \Illuminate\Support\Facades\Auth::user();
                $full_name = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
            @endphp

            <div class="d-flex align-items-stretch">
                @if ($user->display_picture_link == '-')
                    <img src="/storage/default.jpg" alt="" class="rounded-circle"
                        style="width: 45px; height: 45px; object-fit: cover;">
                @else
                    <img src="{{ $user->display_picture_link }}" alt="" class="rounded-circle"
                        style="width: 45px; height: 45px; object-fit: cover;">
                @endif
                <p class="text-white ms-2">{{ $full_name }}</p>
            </div>
        @endif
    </div>

    @if (\Illuminate\Support\Facades\Auth::check())
        <div class="bg-info d-flex justify-content-evenly align-items-center pt-2 pb-2">
            <a href="{{ url('/home') }}" class="text-decoration-none text-dark">{{ trans('Home') }}</a>
            <a href="{{ url('/cart') }}" class="text-decoration-none text-dark">{{ trans('Cart') }}</a>
            <a href="{{ url('/history-order') }}"
                class="text-decoration-none text-dark">{{ trans('History Order') }}</a>
            <a href="{{ url('/profile') }}" class="text-decoration-none text-dark">{{ trans('Profile') }}</a>
            @if (strcmp(\Illuminate\Support\Facades\Auth::user()->role->role_desc, 'Admin') == 0)
                <a href="{{ url('/account-maintenance') }}"
                    class="text-decoration-none text-dark">{{ trans('Account Maintenance') }}</a>
            @endif
        </div>
    @endif

</div>
