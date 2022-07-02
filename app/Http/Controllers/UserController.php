<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Session;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function addUser(Request $req) {
        if(strlen($req -> phone) != 11) {
            $req->session()->flash("phoneError", "{$req->phone} is invalid");
            return redirect('/register');
        }
        if(User::where('phone', $req->phone)->count() > 0) {
            $req->session()->flash("userExist", "This User Exists!");
            return redirect('/register');
        }
        $user = new User;
        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->bloodGroup = $req->bloodGroup;
        $user->lastDonated = $req->lastDonated;
        if($user->image) {
            $fileName = strtotime(date("Y-m-d h:i:sa")).rand().".".$req->image->extension();
            $user->image = $fileName;
            $req->image->move('images/users', $fileName);
        }
        $user->password = Hash::make($req->password);
        if(Carbon::parse($req->dob)->diff(Carbon::now())->y < 18) {
            $req->session()->flash("ageError", "This User Cannot Be A Donor!");
            return redirect('/register');
        }
        $user->save();
        return redirect('/searchDonor');
    }
    function login(Request $req) {
        $user = User::where('phone', $req->phone)->first();
        if(User::where('phone', $req->phone)->count() == 0) {
            $req->session()->flash("userExist", "This User Not Exists!");
            return redirect('/login');
        }
        if(Hash::check($req->password, $user->password) === false) {
            $req->session()->flash("errorPassword", "Wrong Password!");
            return redirect('/login');
        }
        $req->session()->put('user', $user);
        return redirect('/');
    }
    function getUser() {
        $users = User::all();
        return view("searchDonor", ["users" => $users, "title"=>"Search User"]);
    }
    function search(Request $req) {
        $search = $req->query('search');
        if(empty($search)) {
            return "<script>alert('Please enter blood group')</script>";
        }
         $users = User::where('bloodGroup', 'LIKE', $search)->get();
        return view('search', ["users" => $users]);  
    }
    function profile() {
        if(!Session::has('user')) {
            return redirect('/login');
        }
        $id = Session::get('user')['id'];
        $user = User::find($id);
        return view('profile', ["user" => $user]);
    }
}
