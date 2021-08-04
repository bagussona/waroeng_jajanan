@extends('layouts.ecommerce')
{{-- {{ url('profile/profile.css')}} --}}

@section('title')
    <title>Profile - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
<div>
    <div class="row">1</div>
    <div class="row">2</div>
    <div class="row">3</div>
    <div class="row">4</div>
    <div class="row">5</div>
    <div class="row">6</div>
</div>
<div class="container emp-profile mt-4">
    <form method="post">
        <div class="row justify-content-center">
            <div class="col-md-4 justify-content-center">
                <div class="profile-img">
                    <img src="{{ $profile->avatar }}" alt="" width="40%" class="rounded-circle" align="center"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                                {{ $profile->name}}
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
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="profile-work">
                    <p></p>
                    <p>Pesanan Saya</p>
                    <a href="">Belum Bayar</a><br/>
                    <a href="{{ route('front.notfound') }}">Beri Penilaian</a><br/>
                    <a href="">Sudah Bayar</a><br/>
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
                                    <div class="col-md-6">
                                        <label>Alamat (1)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Kp. Wanasari, RT/RW 005/026, Garut Kota, Garut. 44112</p>
                                        <p>[Bagus Sonarangga]</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Alamat (2)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Jl. Ciledug No.299, RT/RW 001/014, Garut Kota, Garut, 44112 </p>
                                        <p>[Linda Firyani]</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Alamat (3)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Pondok Programmer, Desa Tirtohargo Dsn, RT/RW 01/00, Kalangan, Gegunung, Tirtohargo, Kretek, 55772</p>
                                        <p>[Bagus Sonarangga]</p>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
