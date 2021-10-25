@extends('layouts.ecommerce')
@section('title')
    <title>Profile - {{ env('APP_NAME') }}</title>
@endsection
@section('content')
<style>

    .container-profile{
        margin: 0%;
    }
    .header-profile{
        padding-top: 7%;
        padding-left: 15%;
        padding-right: 15%;
    }
    .header-image{
        align-items: center;
        width: 15%;
        height: 100%;
        padding: 1%;
    }
    .header-name{
        width: 70%;
        height: 30%;
        padding: 1%;
    }
    .header-profile-edit{
        width: 15%;
        height: 30%;
    }
    .content-left{
        width: 25%;
        padding-top: 1%;
        padding-left: 15%;
        /* padding-right: 5%; */
        padding-bottom: 1%;
    }

    .content-right{
        /* display: flex; */
        box-sizing: border-box;
        width: 50%;
        height: auto;
        padding: 1%;
    }
    .profile-edit-btn{
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .card-sendiri{

        margin: 8px;
        width: 200px;
        height: 200px;
    }

    .card-deck{
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        width: 900px;
        height: auto;
    }

    .card-body{
        margin-left: 15%;
        width: 200px;
        /* margin: 10px; */
        /* background-color: #ECF0F1; */
        box-shadow:rgba(0, 0, 0, 0.24) 0px 0px 8px;
        /* flex: 0 0 0 1; */
    }

    .content-end{
        width: 25%;
    }

</style>
<div class="container-fluid">
    <div class="header-profile d-flex align-items-center">
        <div class="header-image">
            <img src="{{ $profile->avatar }}" class="rounded-circle" style="width: 100%; height: 100%; center">
        </div>
        <div class="header-name">
            <div class="profile-head d-flex" style="padding-top: 2%; margin-bottom: 2%">
                <div class="name-head" style="width: 70%; padding-left: 1%;">
                    <h3>{{ $profile->name }}</h3>
                    <h6>{{ $profile->email }}</h6>
                    <h6>Phone: {{ $profile->nohape }}</h6>
                </div>
                <div class="name-middle d-flex flex-column" style="width: 30%; padding-right: 3%; text-align: right;">
                    <p class="proile-rating">Registered_as: <span style="text-align-right"> {{ $profile->role_names[0] }} </span></p>
                    <p style="margin-bottom: 0;" class="proile-rating">Sudah Jajan: <span style="text-align-right">Rp. {{ number_format($sudah_bayar) }} </span></p>
                    <p style="margin-bottom: 0;" class="proile-rating">Sisa Hutang: <span style="text-align-right">Rp. {{ number_format($sisa_hutang) }} </span></p>
                </div>
            </div>
            <div class="nav-jajanan"">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Jajanan Ku</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="profile-edit" style="align-items: top;">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit Profile</button>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="content-wrapper d-flex">
        <div class="content-left">
            <div class="content-left-title">
                <span>Profile</span>
            </div>
            <div class="content-left-content">
                <a href="{{ route('front.UserProfile')}}"><h4 style="color: #6c757d;">{{ $profile->username }}</h4></a><br/>
            </div>
        <div class="content-left-title">
            <span>Pesanan Saya</span>
        </div>
        <div class="content-left-content">
            <a href="{{ route('front.UserProfile')}}">Riwayat Jajananku</a><br/>
            <a href="{{ route('front.notfound') }}">Beri Penilaian</a><br/>
        </div>
    </div>
    <div class="content-right">
        <div class="card-deck">
            @forelse ($order_detail as $val)
            <div class="card-sendiri">
                <div class="card-body">
                    <div class="title">
                        <h5 class="card-title">{{ $val->status}}</h5>
                    </div>
                    <div class="content">
                        <p class="card-text">Invoice: {{$val->invoice}}</p>
                        <p class="card-text"><small class="text-muted">Subtotal: {{$val->subtotal}}</small></p>
                    </div>
                    <div class="footer">
                        <form action="{{ route('front.OrderanView') }}" method="post">
                        @csrf
                        <input type="hidden" name="invoice" value="{{ $val->invoice }}">
                        <p class="card-text" style="text-align: right"><button type="submit" class="btn btn-light">view</button></p>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-deck">
                <h2>empty</h2>
            </div>
            @endforelse
        </div>
        <div class="page_linkers" style="padding-top: 5%;">
        {{ $order_detail->links() }}
        </div>
    </div>
    <div class="content-end">
    </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h3 class="modal-title">Edit Profile</h3>
      </div>
      <form action="{{ route('front.UpdateProfile') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <!-- Modal body -->
        <div class="container">
            <div class="row pt-3">
              <!-- left column -->
              <div class="col-md-5">
                <div class="text-center">
                  <img src="{{ $profile->avatar }}" width="50%" class="rounded-circle image-profile" alt="avatar">
                  <h6></h6>

                  <input name="avatar" id="avatar" type="file" class="form-control">
                </div>
              </div>

              <!-- edit form column -->
              <div class="col-md-7 personal-info">
                  <!-- KETIKA ADA SESSION SUCCESS  -->
                  @if (session('success'))
                  <!-- MAKA TAMPILKAN ALERT SUCCESS -->
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- KETIKA ADA SESSION ERROR  -->
                @if (session('error'))
                  <!-- MAKA TAMPILKAN ALERT DANGER -->
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h3>Personal info</h3>

                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Full Name:</label>
                    <div class="col-lg">
                      <input name="name" class="form-control" type="text" value="{{ $profile->name }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Username:</label>
                    <div class="col-lg">
                      <input name="username" class="form-control" type="text" value="{{ $profile->username }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg">
                      <input name="email" class="form-control" type="text" value="{{ $profile->email }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Phone:</label>
                    <div class="col-md">
                      <input name="nohape" class="form-control" type="text" value="{{ $profile->nohape }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Gender:</label>
                    <div class="col-md-8">
                        <select name="gender" class="form-control">
                            <option value="Undefined">Pilih</option>
                            <option value="{{ $profile->gender }}" {{ $profile->gender == $profile->gender ? 'selected':'' }}>{{ $profile->gender }}</option>
                            <option value="Wanita">Wanita</option>
                            <option value="Pria">Pria</option>
                        </select>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <span></span>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    </div>
    </div>
      </div>
    </div>
  </div>

@endsection
