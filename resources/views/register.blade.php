<x-header title="Registration"/>
<div>
    <div class="row w-100 d-flex" style="align-items: center;">
        <div class="col-md-6">
            <img style="width: 100%; height: 100%; object-fit: cover"
            src="images\Registration.svg" alt="">
        </div>
        <div class="col-md-6 form-container">
            <form action="/add-user" class="register row g-3" method="post" enctype="multipart/form-data">
                <h3 class="text-center">Registration</h3>
                @csrf
                <div class="col-md-6">
                    <label for="inputEmail1" class="form-label">Full Name</label>
                    <span style="color: red"> * Required Feild</span>
                    <input type="text" name="name" class="form-control" id="inputEmail1" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail2" class="form-label">Phone Number</label>
                    <span class="ml-auto" style="color: red"> * Required Feild</span>
                    <input type="number" name="phone" class="form-control" id="inputEmail2" required>
                    @if(Session::has('phoneError'))
                        <p class="text-danger">{{Session('phoneError')}}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="inputEmail3" class="form-label">Email (Optional)</label>
                    <input type="email" name="email" class="form-control" id="inputEmail3" >
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Date Of Birth (mm/dd/yyyy)</label>
                    <span style="color: red"> * Required Feild</span>
                    <input type="date" name="dob" class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail6" class="form-label">Address</label>
                    <span style="color: red"> * Required Feild</span>
                    <textarea name="address" id="inputEmail6" class="form-control" required>Address</textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Blood Group</label>
                    <span style="color: red"> * Required Feild</span>
                    <select name="bloodGroup" class="form-select" id="" required>
                        <option>Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail6" class="form-label">Last Donated (mm/dd/yyyy)</label>
                    <span style="color: red"> * Required Feild</span>
                    <input type="date" name="lastDonated" class="form-control" id="inputEmail6" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail7" class="form-label">Upload Image (Optional)</label>
                    <input type="file" name="image" class="form-control" id="inputEmail7">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail8" class="form-label">Set Password</label>
                    <span style="color: red"> * Required Feild</span>
                    <input type="password" name="password" class="form-control" id="inputEmail8" required>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
                <p class="text-center">Do You Have An Account ? <a href="/login" class="text-primary">Login</a></p>
                @if(Session::has('userExist'))
                <h5 class="my-2 alert alert-danger text-center">{{Session('userExist')}}</h5>
                @endif
                @if(Session::has('ageError'))
                <h5 class="my-2 alert alert-danger text-center">{{Session('ageError')}}</h5>
                @endif
            </form>
        </div>
    </div>
</div>
<x-footer />