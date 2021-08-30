@extends('layouts.admin')

@section('title')
    <title>Inquiry</title>
@endsection

@section('content')

<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active">Inquiry Transaksi</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="margin-bottom: 0;">Inquiry</h4>
                        </div>
                        <div class="card-body">
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->

                            <form action="{{ route('reports.inquiry') }}" method="get">
                                <div class="container-wrapper d-flex flex-row">
                                <div class="header-inquiry d-flex flex-column" style="width: 50%; padding-bottom: 25px; padding-left: 15px;">
                                    <label for="header-name"">Group by</label>
                                    <div class="header-inquiry-name d-flex flex-row">
                                    <label for="inquiry_name" style="margin-left: 15px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 30px; line-height: 30px;">Name:</label>


                                    <select name="inquiry_name" style="width: 526px;">
                                    <option value="">-- All --</option>
                                    @foreach ( $customer_name as $name)
                                        <option value="{{ $name->customer_name }}">{{ $name->customer_name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <label for="header-date" style="margin-top: 15px;">Periode / Tahun</label>
                                    <div class="header-inquiry-date d-flex flex-row">
                                        <label for="datepickerform" style="margin-left: 15px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 35px; line-height: 35px;">Periode: </label>
                                        <input id="datepickerfrom" name="datepickerfrom" width="250" />
                                        <script>
                                            $('#datepickerfrom').datepicker({
                                                uiLibrary: 'bootstrap4'
                                            });
                                        </script>
                                        <label for="datepickerto" style="margin-left: 5px; margin-right: 5px; margin-bottom: 0; height: 35px; line-height: 35px;">s/d: </label>
                                        <input id="datepickerto" name="datepickerto" width="250" />
                                        <script>
                                            $('#datepickerto').datepicker({
                                                uiLibrary: 'bootstrap4'
                                            });
                                        </script>
                                    </div>
                                    <label for="information" style="margin-left: 15px; margin-top: 10px; margin-bottom: 0; font-size: 9px;">* ketentuan inquiry, 1 hari = 24 jam</label>
                                    <label for="information" style="margin-left: 15px; margin-top: 5px; margin-bottom: 0; font-size: 9px;">* e.g : 2021-01-01 s.d 2021-01-02 (1 hari)</label>
                                </div>
                                <div class="header-inquiry-type d-flex flex-column" style="width: 50%; padding-bottom: 25px; padding-right: 15px;">
                                    <label for="header-name">Inquiry berdasarkan</label>
                                    <div class="header-inquiry-status d-flex flex-row">
                                    <label for="inquiry_status" style="width: 100px; height: 30px; line-height: 30px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">Status:</label>
                                        <select name="inquiry_status">
                                            <option value="">All</option>
                                            @foreach ( $status_order as $status )
                                            <option value="{{ $status->status }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                    <label for="inquiry_type_product" style="margin-left: 150px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 30px; line-height: 30px;">Product:</label>
                                        <select name="inquiry_type_product">
                                            <option value="">All</option>
                                            @foreach ( $product_order as $product )
                                            <option value="{{ $product->name }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="inquiry-type-invoice" style="margin-top: 15px;">Faktur Nota</label>
                                    <div class="header-type-invoice d-flex flex-row">
                                        <label for="inquiry_invoice_string" style="width: 100px; height: 30px; line-height: 30px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">Invoice:</label>
                                        <input type="text" name="inquiry_invoice_string" maxlength="4" style="width: 10%; height: 30px;">
                                        <label for="inquiry_invoice_date" style="height: 30px; line-height: 30px; margin-left: 5px; margin-right: 5px; margin-bottom: 0;">-</label>
                                        <input type="text" name="inquiry_invoice_date" maxlength="10" style="width: 40%; height: 30px;">
                                        <button type="submit" name="inquiry" class="btn btn-primary" style="margin-left: 50px; margin-right: 50px;"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                            <hr style="margin: 0 15px 25px 15px;">

                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="container-wrapper">
                                <div class="wrapper d-flex flex-row">
                                <div class="content1" style="width: 76%;">
                                <table class="styled-table"style="border-collapse: collapse; margin: 0 0 25px 0; font-size: 0.9em; font-family: sans-serif; min-width: 400px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                    <thead>
                                    <tr style="background-color: #009879; color: #ffffff;">
                                        <th style="padding: 12px 15px; text-align: center; width: 100px;">Invoice</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 100px;">Tanggal</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 250px;">Nama Pelanggan</th>
                                        <th style="padding: 12px 15px; text-align: center;">No HP</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 125px;">Subtotal</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 125px;">Telah Bayar</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 125px;">Sisa Hutang</th>
                                        <th style="padding: 12px 15px; text-align: center; width: 100px;">Status</th>
                                        <th style="padding: 12px 15px; text-align: center;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($results as $result)
                                    <tr style="border-bottom: 1px solid #dddddd;">
                                        <td style="padding: 5px 15px; text-align: left;">{{ $result->invoice }}</td>
                                        <td style="padding: 5px 15px; text-align: left;">{{ date('Y-m-d', strtotime($result->created_at)) }}</td>
                                        <td style="padding: 5px 15px; text-align: left;">{{ $result->customer_name }}</td>
                                        <td style="padding: 5px 15px; text-align: left;">{{ $result->customer_phone }}</td>
                                        <td style="padding: 5px 15px; text-align: right;">{{ $result->subtotal }}</td>
                                        <td style="padding: 5px 15px; text-align: right;">{{ $result->telah_bayar }}</td>
                                        <td style="padding: 5px 15px; text-align: right;">{{ $result->sisa_hutang }}</td>
                                        <td style="padding: 5px 15px; text-align: center;">{{ $result->status }}</td>
                                        {{-- <form action="{{ route('reports.inquiryDetails') }}" method="get"> --}}
                                        {{-- <input type="hidden" name="invoice_loop" value="{{ $result->invoice }}"> --}}
                                        <td style="padding: 5px 15px;"><button id="details" class="btn btn-light" value="{{ $result->invoice }}" onclick="testClick(this.value)"> details </button></td>
                                        {{-- </form> --}}
                                    </tr>
                                    <tr>
                                        @empty
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                </div>
                                <div class="content2" style="width: 24%">
                                    <div class="card_deck d-flex flex-column" style="width: 385px; height: 325px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                        <div class="heading_card_deck">
                                            <h2 style="background-color: #009879; color: #ffffff; font-size: 0.9rem; font-family: sans-serif; text-align: center; padding: 12px 15px;"><strong>Detail Orderan</strong></h2>
                                        </div>
                                        <div class="header_card_deck d-flex flex-column">
                                            <div class="invoice d-flex flex-row">
                                                <label id="invoice_name" for="invoice_name" style="margin-bottom: 0; margin-left: 10px; padding: 5px 0 5px 0; width: 50px; font-size: 0.8rem; text-align: left;">Invoice</label>
                                                <label for="invoice_quote" style="margin-bottom: 0; margin-left: 10px; padding: 5px 0 5px 0; width: 15px; font-size: 0.8rem; text-align: left;">:</label>
                                                <label id="invoice" for="invoice" style="margin-bottom: 0; margin-left: 10px; padding: 5px 0 5px 0; width: 200px; font-size: 0.8rem; text-align: left;"></label>
                                                <label id="invoice_date" for="invoice_date" style="margin-bottom: 0; margin-right: 10px; padding: 5px 0 5px 0; width: 75px; font-size: 0.8rem; text-align: right;"><small></small></label>
                                            </div>
                                        </div>
                                        <hr id="boundary-line" style="margin: 15px; height: 5px;">
                                        <!-- <div class="content_card_deck d-flex flex-column" style="height: 250px;">
                                            <div class="content d-flex flex-row">
                                                <label id="product_name" for="product" style="margin-bottom: 0; padding: 5px 15px; width: 235px; font-size: 11px;"></label>
                                                <label id="amount" for="qty" style="margin-bottom: 0; padding: 5px 15px; width: 50px; text-align: right; font-size: 11px;"></label>
                                                <label id="subtotal" for="subtotal" style="margin-bottom: 0; padding: 5px 15px; width: 100px; text-align: right; font-size: 11px;"><strong></strong></label>
                                            </div>
                                        </div> -->
                                        <hr style="margin: 0 15px 0 15px; height: 5px;">
                                        <div class="footer_card_deck">
                                            <label id="grand_total" for="total" style="width: 385px; margin-bottom: 0; padding: 0 15px 0 15px; text-align: right; height: 50px; line-height: 50px;"><strong>Total. </strong></label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            {!! $results->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>

  const insertAfter = (referenceNode, newNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }

  var hr = document.getElementById('boundary-line');

  const testClick = val => {
      axios.get(`http://127.0.0.1:8000/api/reports/inquiry/${val}`)
      .then(res => {
        console.log(res);
        (res.data.data).map(invoice_data => {
          var invoice = createSeveralElements(invoice_data);

          insertAfter(hr, invoice);
        })
      })
      .catch(err => console.log(err));
  };

</script>
@endsection
