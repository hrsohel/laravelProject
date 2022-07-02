<x-header title="Login"/>
<div class="login">
    <div class="row w-100 d-flex" style="align-items: center">
        <div class="col-md-6 my-3" data-aos="fade-right">
            <img src="images\login.svg" alt="" class="img-fluid">
        </div>
        <div class="col-md-6 my-3" data-aos="fade-right">
            <form action="/login-user" method="post" class="row g-3 register">
            <h3 class="text-center">Login</h3>
                @csrf
                <div class="col-md-6">
                    <label for="inputEmail1" class="form-label">Mobile Number</label>
                    <!-- <span style="color: red"> * Required Feild</span> -->
                    <input type="number" name="phone" class="form-control" id="inputEmail1" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail2" class="form-label">Password</label>
                    <!-- <span style="color: red"> * Required Feild</span> -->
                    <input type="password" name="password" class="form-control" id="inputEmail2" required>
                </div>
                <input type="submit" value="Login" class="btn btn-primary">
                <p class="text-center"><a href="/register" class="text-primary">Create a new account.</a></p>
                @if(Session::has('userExist'))
                    <div class="alert alert-danger">{{Session::get('userExist')}}</div>
                @endif
                @if(Session::has('errorPassword'))
                    <div class="alert alert-danger">{{Session::get('errorPassword')}}</div>
                @endif
                </form>
        </div>
    </div>
</div>
<x-footer />