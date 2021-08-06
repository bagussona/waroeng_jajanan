@extends('layouts.ecommerce')
{{-- {{ url('profile/profile.css')}} --}}

@section('title')
    <title>Profile - {{ env('APP_NAME') }}</title>

<style>

.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 50%;
    height: 50%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 50%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}

.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
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

.profile-head .pf-tabs{
    margin-bottom:5%;
}
.profile-head .pf-tabs .pf-link{
    font-weight:600;
    border: none;
}
.profile-head .pf-tabs .pf-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    /* color: #0062cc; */
}

#home{
    color: #818182;
}
</style>
@endsection

@section('content')
<div>
    <div class="row">1</div>
    <div class="row">2</div>
    <div class="row">3</div>
</div>
<div class="container emp-profile mt-4">
    <form method="post">
        <div class="row justify-content-center">
            <div class="col-md-4 justify-content-center">
                <div class="profile-img">
                    <img src="{{ $profile->avatar }}" width="20%" class="rounded-circle" align="center"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                                {{ $profile->name }}
                            </h5>
                            <p class="proile-rating">Registered_as: <span> {{ $profile->role_names[0] }} </span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Alamat</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">

                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                    Edit Profile
                </button>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="profile-work">
                    <p></p>
                    <p>Profile Detail</p>
                    <a href="{{ route('front.UserProfile')}}">{{ $profile->name }}</a><br/>
                </div>
                <div class="profile-work">
                    <p></p>
                    <p>Pesanan Saya</p>
                    <a href="{{ route('front.UserOrderanku')}}">Riwayat Jajananku</a><br/>
                    <a href="{{ route('front.notfound') }}">Beri Penilaian</a><br/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->id }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->nohape }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->gender }}</p>
                                    </div>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="profile-head">
                                        <h5>
                                            SEGERA RILIS! FITUR ALAMAT AKAN DITAMBAHKAN NANTI.
                                        </h5>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                  <img src="{{ $profile->avatar }}" width="50%" class="rounded-circle" alt="avatar">
                  <h6></h6>

                  <input name="avatar" type="file" class="form-control">
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
