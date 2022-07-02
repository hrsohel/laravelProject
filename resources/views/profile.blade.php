<x-header title="{{Session::get('user')['name']}}'s Profile"/>
<?php use Carbon\Carbon; ?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-4 border">
            <div class="profile-pic my-5 mx-auto">
                @if($user['image'])
                    <img src="images/users/{{$user['image']}}" alt="" class="img-fluid">
                @else
                    <img class="img-fluid" src="images\profileimages.png" alt="">
                @endif
                <h3 class="text-center">{{$user['name']}}</h3>
            </div>
            <a href="/update-user" class="btn btn-outline-primary my-2 w-100">Update Profile</a>
        </div>
        <div class="col-md-8">
            <div class="row my-5">
                <h1 class="text-center" style="border-bottom: 2px solid black">Personal Information</h1>
                <div class="col-6">
                    <h5>Phone Number</h5>
                    <h5>Email</h5>
                    <h5>Address</h5>
                    <h5>Age</h5>
                    <h5>Blood Group</h5>
                    <h5>Last Donated</h5>
                </div>
                <div class="col-6">
                    <h5>0{{$user['phone']}}</h5>
                    <h5>{{$user['email'] ? $user['email'] : "N/A"}}</h5>
                    <h5>{{$user['address']}}</h5>
                    <h5>{{Carbon::parse($user['dob'])->diff(Carbon::now())->y}}</h5>
                    <h5>{{$user['bloodGroup']}}</h5>
                    <h5>{{$user['lastDonated']}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer />