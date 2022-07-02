<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Carbon\Carbon;
use Session;

use Illuminate\Http\Request;

class UserUpdate extends Controller
{
    function user() {
        if(!Session::has('user')) {
            return redirect('/login');
        }
        $id = Session::get('user')['id'];
        $user = User::find($id);
        return view('updateProfile', ["user" => $user]);
    }
    function updateUser(Request $req) {
        if(strlen($req -> phone) != 11) {
            $req->session()->flash("phoneError", "{$req->phone} is invalid");
            return redirect('/update-user');
        }
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->bloodGroup = $req->bloodGroup;
        $user->lastDonated = $req->lastDonated;
        if($req->image) {
            $fileName = strtotime(date("Y-m-d h:i:sa")).rand().".".$req->image->extension();
            
            $del = File::delete('images/users/' . $user->image);
            $user->image = $fileName;
            $req->image->move('images/users', $fileName);
        } else {
            $user->image = $user->image;
        }
        if(Carbon::parse($req->dob)->diff(Carbon::now())->y < 18) {
            $req->session()->flash("ageError", "Age Must Be Greater Than 18!");
            return redirect('/update-user');
        }
        $user->save();
        $req->session()->put("user", $user);
        return redirect('/profile');
    }
    function admin($id) {
        $user = User::find($id);
        $user->admin = 1;
        $user->save();
        return redirect('/searchDonor');
    }
    function removeAdmin($id) {
        $user = User::find($id);
        $user->admin = 0;
        $user->save();
        return redirect('/searchDonor');
    }
    function deleteUser($id) {
        $user = User::find($id);
        $del = File::delete("images/users/" . $user->image);
        User::destroy($id);
        return redirect('/searchDonor');
    }
    function changeByAdmin(Request $req) {
        if(!Session::get('user')['admin']) return redirect('/searchDonor');
        $user = User::find($req->id);
        $user->lastDonated = $req->lastDonated;
        $user->save();
        return redirect('/searchDonor');
    }
}
