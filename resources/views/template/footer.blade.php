<div class="w-100 d-flex justify-content-center align-items-center bg-primary text-white position-fixed bottom-0 p-2">
    <span class="fs-2">&copy; Amazing E-Book 2022</span>

    <div class="dropdown ms-4">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{trans('Language')}} - {{\Illuminate\Support\Facades\Session::get('locale') ? strtoupper(\Illuminate\Support\Facades\Session::get('locale')) : strtoupper(config('app.locale'))}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{url('/switchLang/en')}}">English</a></li>
            <li><a class="dropdown-item" href="{{url('/switchLang/id')}}">Indonesia</a></li>
        </ul>
    </div>

</div>
