<!-- MEMANGGIL MASTER TEMPLATE YANG SUDAH DIBUAT SEBELUMNYA, YAKNI admin.blade.php -->
@extends('layouts.admin')

@section('title')
    <title>Member - {{ env('APP_NAME') }}</title>

    <style>
        body{
            margin-top:20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100%!important;
        }

        .shadow-none {
            box-shadow: none!important;
        }

    </style>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Pengguna Terdaftar</li>
        <li class="breadcrumb-item">Semua Pengguna</li>
        <li class="breadcrumb-item active">{{ $profile->name }}</li>
    </ol>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="{{ $profile->avatar }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<h4>{{ $profile->name}}</h4>
									<p class="text-secondary mb-1">{{ $profile->email }}</p>
									<p class="text-muted font-size-sm">ROLE: {{ $profile->role_names[0] }}</p>
                                    <hr class="my-4">
									<button class="btn btn-primary">Follow</button>
									<button class="btn btn-outline-primary">Message</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
                        <form action="{{ route('members.update', $profile->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="name" type="text" class="form-control" value="{{ $profile->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="username" type="text" class="form-control" value="{{ $profile->username}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="email" type="email" class="form-control" value="{{ $profile->email}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="phone" type="text" class="form-control" value="{{ $profile->nohape }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="gender" type="text" style="background-color: #fff" class="form-control" value="{{ $profile->gender }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-sm-12 float-right">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
                                <div class="card-header">
                                  Total Transaksi
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote mb-0">
                                    <p>Rp. {{ $total_transaksi }}</p>
                                  </blockquote>
                                </div>
                              </div>
                        </div>
                        <div class="col-sm-6">
                              <div class="card">
                                <div class="card-header">
                                    Sisa Hutang
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote mb-0">
                                    <p>Rp. {{ $sisa_hutang }}</p>
                                  </blockquote>
                                </div>
                              </div>
                        </div>
                        <div class="col-sm-12">
                              <div class="card">
                                <div class="card-header">
                                  Riwayat Order
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote mb-0">
                                    <ul class="list-group vw-100">
                                        @foreach ($orders as $order)
                                        <li class="list-group-item d-flex flex-row">
                                            <span style="font-size: 11px; width: 100px;">{{ date('d/m/Y', strtotime($order->created_at)) }}</span>
                                            <p style="font-size: 16px; width: 200px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">{{ $order->invoice }}</p>
                                            <span style="margin-left: 5px; margin-right: 5px; width: 50px; color: #ffffff;">:</span>
                                            <span style="margin-left: 250px; margin-right: 200px; width: 75px; font-size: 16px; margin-bottom: 0;" class="badge bg-primary rounded-pill"><small> {{ $order->status }} </small></span>
                                            <span style="width: 150px; text-align: right;">Rp. {{ $order->subtotal }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="pagination" style="padding: 15px;">
                                        {{ $orders->links() }}
                                    </div>
                                  </blockquote>
                                </div>
                              </div>
                        </div>
                        <div class="col-sm-12">
                              <div class="card">
                                <div class="card-header">
                                  Keranjang Belanja
                                </div>
                                <div class="card-body">
                                  <blockquote class="blockquote mb-0">
                                    <ul class="list-group vw-100">
                                        @foreach ($carts as $cart)
                                        <li class="list-group-item d-flex flex-row">
                                            <span style="font-size: 11px; width: 100px;">{{ date('d/m/Y', strtotime($cart->tanggal)) }}</span>
                                            <p style="font-size: 16px; width: 500px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">{{ $cart->name }}</p>
                                            <span style="margin-left: 5px; margin-right: 5px; width: 50px; color: #ffffff;">:</span>
                                            <span style="margin-left: 25px; margin-right: 50px; width: 75px; font-size: 16px; margin-bottom: 0;" class="badge bg-primary rounded-pill"><small> {{ $cart->qty }} </small></span>
                                            <span style="width: 150px; text-align: right;">Rp. {{ $cart->subtotal }}</span>
                                            <form action=" {{ route('front.admindelete_cart') }} " method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="product_id" value="{{ $cart->id }}">
                                                    <button class="btn btn_danger" style="margin-left: 15px;"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="pagination" style="padding: 15px;">
                                        {{ $carts->links() }}
                                    </div>
                                  </blockquote>
                                </div>
                              </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

</main>
@endsection
