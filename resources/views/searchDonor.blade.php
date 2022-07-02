<x-header title="Search Donor"/>
<?php use Carbon\Carbon; ?>
<div class="table-container" style="overflow-x: auto">
    <table class="px-1 text-center" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Available</th>
            <th>Last Donated (yyyy/mm/dd)</th>
            @if(Session::has('user') && Session::get('user')['admin']) <th>Actions</th> @endif
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user['name']}}</td>
            <td>0{{$user['phone']}}</td>
            <td>{{$user['address']}}</td>
            <td>{{$user['bloodGroup']}}</td>
            <td>
                @if((Carbon::parse($user['lastDonated'])->diff(Carbon::now())->m) >=3)
                 Yes 
                @else 
                 No
                @endif 
            </td>
            <td>
                {{$user['lastDonated']}}
                ({{(Carbon::parse($user['lastDonated'])->diff(Carbon::now())->m)}} months ago)
            </td>
            @if(Session::has('user') && Session::get('user')['admin'])
                <td>
                    <i style="cursor:pointer; margin-right: .3rem" class="fa-solid fa-file-pen text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user['id']}}" data-bs-whatever="@mdo"></i>
                    <div class="modal fade" id="exampleModal{{$user['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Admin can change only user's last donation date</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/changeByAdmin" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$user['id']}}">  
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Last Donated (mm/dd/yyyy)</label>
                                    <input type="date" value="{{$user['lastDonated']}}" class="form-control" name="lastDonated" id="recipient-name">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div> -->
                                <input type="submit" class="btn btn-primary" value="Update"/>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    <a href="deleteUser/{{$user['id']}}" onclick="return confirm('Do you want to delete this user?')"><i style="margin-right: .2rem; cursor: pointer" class="fa-solid fa-xmark text-danger"></i></a>
                    @if($user['admin'])
                        <a href="/removeAdmin/{{$user['id']}}" onclick="return confirm('Do you want to remove this user from admin?')"><i style="cursor: pointer; margin-right: .3rem" class="fa-solid fa-user-check text-success"></i></a>
                    @else
                        <a href="/makeAdmin/{{$user['id']}}" onclick="return confirm('Do you want to make this user admin?')"><i style="cursor: pointer; margin-right: .3rem" class="fa-solid fa-user text-success"></i></a>
                    @endif
                </td>
            @endif
        </tr>
        @endforeach
        
    </table>

</div>
<x-footer />