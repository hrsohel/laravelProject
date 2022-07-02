<x-header title="Search Donor"/>
<?php use Carbon\Carbon; ?>
<div style="overflow-x: auto">
    <table class="px-1 text-center" style="border-collapse: collapse; width: 100%;">
    @if(count($users) > 0)
        <tr>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Available</th>
            <th>Last Donated</th>
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
        </tr>
        @endforeach
    @endif
    @if(count($users) === 0)
        <p class="alert alert-danger">No Record Found</p>
    @endif
    </table>
</div>
<x-footer />