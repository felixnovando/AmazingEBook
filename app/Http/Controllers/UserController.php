<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;
//Created By 2301859543 – Felix Novando – LD01

class UserController extends Controller
{
    public static function setLang(){
        if($locale = Session::get('locale')){
            app()->setLocale($locale);
        }
    }

    public function switchLang($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function index(){
        UserController::setLang();
        return view('pages.index');
    }

    public function getSignUpPage(){
        UserController::setLang();
        $roles = Role::all();
        return view('pages.signup', compact('roles'));
    }

    public function getLoginPage(){
        UserController::setLang();
        return view('pages.login');
    }

    public function login(Request $request){
        UserController::setLang();
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials)){
            return redirect('/home');
        }else{
            return redirect()->back()->withErrors(['error' => trans('Invalid email or password')]);
        }
    }

    public function logout(){
        UserController::setLang();
        Auth::logout();
        Session::put('message', trans("Log Out Success!"));
        return redirect('/successPage');
    }

    public function getAccountMaintenancePage(){
        UserController::setLang();
        $users = User::where("delete_flag", "=", 0)->get();
        return view('pages.AccountMaintenance', compact('users'));
    }

    public function getUpdateProfilePage(){
        UserController::setLang();
        $roles = Role::all();
        return view('pages.profile', compact('roles'));
    }

    public function deleteUser(Request $request){
        UserController::setLang();
        $user = User::find($request->id);
        $user->delete_flag = 1;
        $user->save();
        return redirect()->back();
    }

    public function getUpdateRolePage($id){
        UserController::setLang();
        $user = User::where("id", "=", $id)->first();
        $roles = Role::all();
        if(is_null($user)){
            return redirect()->back();
        }
        return view('pages.UpdateRolePage', compact('user', 'roles'));
    }

    public function updateRole(Request $request){
        UserController::setLang();
        $request->validate([
            'role_id' => 'required',
        ],[
            'role_id.required' => trans("Role Must Be Selected"),
        ]);

        //cek role valid ga (ga nembak)
        $role_id = $request->role_id;
        $role = Role::where("role_id", '=', $role_id)->first();
        if(is_null($role)){
            return redirect()->back()->withErrors(['error' => trans('Invalid Role')]);
        }

        //klu misalnya user tidak valid
        $user = User::where("id", "=", $request->id)->first();
        if(is_null($user)){
            return redirect()->back()->withErrors(['error' => trans("Invalid User")]);
        }

        $user->role_id = $request->role_id;
        $user->save();
        return redirect('/account-maintenance');
    }

    public function updateProfile(Request $request){
        UserController::setLang();
        $request->validate([
            'first_name' => 'required|alpha_num|max:25',
            'middle_name' => 'nullable|alpha_num|max:25',
            'last_name' => 'required|alpha_num|max:25',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'picture' => 'required|mimes:png,jpeg,gif',
        ],[
            'first_name.required' => trans("First Name Must Be Filled"),
            'first_name.alpha_num' => trans("First Name Cannot Contain Symbol"),
            'first_name.max:25' => trans("First Name Maximum Character Length Is 25"),

            'middle_name.alpha_num' => trans("Middle Name Name Cannot Contain Symbols"),
            'middle_name.max:25' => trans("Middle Name Maximum Character Length Is 25"),

            'last_name.required' => trans("Last Name Must Be Filled"),
            'last_name.alpha_num' => trans("Last Name Cannot Contain Symbols"),
            'last_name.max:25' => trans("Last Name Maximum Character Length Is 25"),

            'gender.required' => trans("Gender Must Be Selected"),

            'email.required' => trans("Email Must Be Filled"),
            'email.email' => trans("Email Must Be Correct Format"),

            'password.required' => trans("Password Must Be Filled"),
            'password.min:8' => trans("Password Minimum Character Length Is 8"),

            'picture.required' => trans("Picture Must Be Selected"),
            'picture.mimes' => trans("Must Only Picture Format")
        ]);

        //cek password ada digit (1 angka)
        $password = $request->password;
        $isNum = false;
        for($i=0; $i<strlen($password); $i++){
            if($password[$i] >= '0' &&  $password[$i] <= '9'){
                $isNum = true;
                break;
            }
        }
        if($isNum == false){
            return redirect()->back()->withErrors(['error' => trans("Password Must Contain Atleast 1 Number")]);
        }

        $uploaded_file = $request->file('picture');
        $picture_name = time() . '_' . $uploaded_file->getClientOriginalName();
        Storage::putFileAs('public/uploads/', $uploaded_file, $picture_name);


        $user = Auth::user();
        $user->gender_id = strcmp($request->gender, 'male') ? 1 : 2;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->display_picture_link = 'storage/uploads/' . $picture_name;
        $user->modified_at = now();
        $user->modified_by = $user->first_name;

        $user->save();

        Session::put('message', 'Saved!!');
        return redirect('/successPage');
    }

    public function signup(Request $request){
        UserController::setLang();
        $request->validate([
            'first_name' => 'required|alpha_num|max:25',
            'middle_name' => 'nullable|alpha_num|max:25',
            'last_name' => 'required|alpha_num|max:25',
            'gender' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'password' => 'required|min:8',
            'picture' => 'required|mimes:png,jpeg,gif',
        ],[
            'first_name.required' => trans("First Name Must Be Filled"),
            'first_name.alpha_num' => trans("First Name Cannot Contain Symbol"),
            'first_name.max:25' => trans("First Name Maximum Character Length Is 25"),

            'middle_name.alpha_num' => trans("Middle Name Name Cannot Contain Symbols"),
            'middle_name.max:25' => trans("Middle Name Maximum Character Length Is 25"),

            'last_name.required' => trans("Last Name Must Be Filled"),
            'last_name.alpha_num' => trans("Last Name Cannot Contain Symbols"),
            'last_name.max:25' => trans("Last Name Maximum Character Length Is 25"),

            'gender.required' => trans("Gender Must Be Selected"),

            'email.required' => trans("Email Must Be Filled"),
            'email.email' => trans("Email Must Be Correct Format"),

            'role_id.required' => trans("Role Must Be Selected"),

            'password.required' => trans("Password Must Be Filled"),
            'password.min:8' => trans("Password Minimum Character Length Is 8"),

            'picture.required' => trans("Picture Must Be Selected"),
            'picture.mimes' => trans("Must Only Picture Format")
        ]);

        $role_id = $request->role_id;
        $role = Role::where("role_id", '=', $role_id)->first();
        if(is_null($role)){
            return redirect()->back()->withErrors(['error' => trans('Invalid Role')]);
        }

        //cek password ada digit (1 angka)
        $password = $request->password;
        $isNum = false;
        for($i=0; $i<strlen($password); $i++){
            if($password[$i] >= '0' &&  $password[$i] <= '9'){
                $isNum = true;
                break;
            }
        }
        if($isNum == false){
            return redirect()->back()->withErrors(['error' => trans("Password Must Contain At least 1 Number")]);
        }

        $uploaded_file = $request->file('picture');
        $picture_name = time() . '_' . $uploaded_file->getClientOriginalName();
        Storage::putFileAs('public/uploads/', $uploaded_file, $picture_name);

        $user = new User([
            'role_id' => $request->role_id,
            'gender_id' => strcmp($request->gender, 'male') ? 1 : 2,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'display_picture_link' => 'storage/uploads/' . $picture_name,
            'modified_at' => now(),
            'modified_by' => $request->first_name,
        ]);
        $user->save();

        return redirect('/login');
    }
}
