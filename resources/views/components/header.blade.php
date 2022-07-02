<?php use Illuminate\Http\Request; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}} </title>
    <link rel="shortcut icon" href="{{url('images\blood-ga7768b22f_1280.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="{{url('images\blood-ga7768b22f_1280.png')}}" /> 450ml</a>
    <i class="fa-solid fa-bars navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></i>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home <div style="{{request()->is('/') ? 'display:block' : ''}}" class="bottom"></div></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchDonor">Search Donor <div style="{{request()->is('searchDonor') ? 'display:block' : ''}}" class="bottom"></div></a>
        </li>
        
        @if(!Session::has('user'))
        <li class="nav-item">
          <a class="nav-link" href="register">Registration <div style="{{request()->is('register') ? 'display:block' : ''}}" class="bottom"></div></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login">Login <div style="{{request()->is('login') ? 'display:block' : ''}}" class="bottom"></div></a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="about">About <div style="{{request()->is('about') ? 'display:block' : ''}}" class="bottom"></div></a>
        </li>
        @if(Session::has('user'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if(Session::get('user')['image'])
                <div class="user-img" ><img src="images\users\{{Session::get('user')['image']}}" alt="" class="img-fluid"></div>
              @endif
              @if(!Session::get('user')['image'])
                <div class="user-img"><img src="images\profileimages.png" alt="" class="img-fluid"></div>
              @endif
              <span class="d-md-none">{{Session::get('user')['name']}}</span>
              </a>
          <ul class="dropdown-menu glass text-white text-center" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
        @endif
      </ul>
      <form method="GET" action="/search" class="d-flex">
        <input class="form-control me-2" name="search" type="search" placeholder="Search Blood Group" aria-label="Search">
        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>
</nav>