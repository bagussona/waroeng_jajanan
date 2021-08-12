<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title>Report Daily - {{ env('APP_NAME') }}</title>
    <script src="https://kit.fontawesome.com/ba382d8b46.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css" rel="stylesheet" media="all">
        /* Base ------------------------------ */

        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;900&display=swap');

        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            font-family: 'Nunito', sans-serif;
            color: #51545E;
        }

        .header-content{
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            background-color: #F4F4F7;
            justify-content: center;
            align-items: center;
            max-width: 100%;
            height: 70px;
        }

        .main-content{
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            /* align-items: center; */
            max-width: 100%;
            height: auto;
            padding-bottom: 2%;
        }

        .header-main-content-middle, .toogletips-main-content-middle, .bodycontent-main-content-middle, .footer-main-content-middle, .bodytable-main-content-middle, .bodyfooter-main-content-middle{
            display: flex;
            flex-direction: row;
        }

        .body-main-content-middle{
            display: flex;
            flex-direction: column;
        }

        /* #table-pendapatan{
            border: 1px solid black;
            border-collapse: collapse;
        } */

        .footer-content{
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            background-color: #F4F4F7;
            justify-content: center;
            align-items: center;
            max-width: 100%;
            height: 99px;
        }

        .footer-content-sign{
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="header-content">
            <div class="header-content-left" style="width: 25%;">
            </div>
            <div class="header-content-center" style="width: 50%;">
                <a style="text-decoration: none;" href="{{ route('front.index') }}"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 20px; font-weight: bold; text-shadow: 0 1px 0 white;">{{ env('APP_NAME') }}</h2></a>
            </div>
            <div class="header-content-right" style="width: 25%;">
            </div>
        </div>
    </div>

    <div class="container-wrapper">
        <div class="main-content">
            <div class="main-content-left" style="width: 25%;">
            </div>
            <div class="main-content-middle" style="width: 50%;">
                <div class="header-main-content-middle" style="margin-bottom: 3%;">
                    <div class="header-main-content-middle-leftside" style="width: 80%; height: 80px; line-height: 80px;"> Akhiri Shift, {{ Auth::user()->name }}<hr style="height:1px;width:84%;border:none;color:#333;background-color:#333;margin-left:150px;margin-right:0px;" /></div>
                    <div class="header-main-content-middle-rightside" style="width: 20%; height: 80px; line-height: 80px; text-align: right;"> Tanggal: {{date('Y-m-d')}}<hr style="height:1px;width:30%;border:none;color:#333;background-color:#333;margin-left:0px;margin-right: 50px;" /></div>
                </div>
                <div class="body-main-content-middle">
                    <div class="toogletips-main-content-middle"  style="height: 50px;">
                        <div class="toogletips-main-content-middle-leftside" style="width: 80%; height: 30px; line-height: 30px;">Pendapatan</div>
                        <div class="toogletips-main-content-middle-leftside" style="width: 20%; height: 30px; line-height: 30px;">Saldo<hr style="height:1px;border:none;color:#333;background-color:#333;" /></div>
                    </div>
                    <div class="bodycontent-main-content-middle"  style="height: 50px;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">Pendapatan Usaha:</div>
                        <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px; text-align: center; color: #0000FF;"> IDR</div>
                    </div>
                    <div class="bodytable-main-content-middle" style="height: auto;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-rightside" style="width: 95% height: 50px;">
                            <table id="table-pendapatan" style="width: 100%;">
                                <tr style="text-align: center;">
                                    <th style="height: 30px; width: 50px; padding-bottom: 2%;">No.</th>
                                    <th style="height: 30px; width: 700px; padding-bottom: 2%;">Produk yang terjual hari ini..</th>
                                    <th style="height: 30px; width: 100px; padding-bottom: 2%;">Qty</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Subtotal</th>
                                </tr>
                                <tr>
                                    <?php $i = 1; ?>
                                    @forelse ($order_all as $val)
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $i++ }}</td>
                                    <td style="text-align: left; font-family: 'Nunito Sans', sans-serif;">{{ $val->products }} ...</td>
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $val->terjual }}</td>
                                    <td style="text-align: right; font-family: 'Nunito Sans', sans-serif;">{{ $val->subtotal }}</td>
                                </tr>
                                <tr>
                                    {{ $order_all->links() }}
                                </tr>
                                <tr>
                                    @empty
                                </tr>
                                @endforelse
                            </table>
                            <div class="bodycontent-main-content-middle"  style="height: 50px; margin-top: 2%; margin-bottom: 2%;">
                                <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                                <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">{{ $order_all->links() }}</div>
                                <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px; text-align: center; color: #0000FF;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bodyfooter-main-content-middle" style="margin-bottom: 5%;">
                        <div class="bodfooter-main-content-middle-leftside" style="width: 10%; height: 50px; line-height: 50px;">
                        </div>
                        <div class="bodyfooter-main-content-middle-center" style="width: 70%; height: 50px; line-height: 50px; color: #0000FF;">Total pendapatan Usaha: </div>
                        <div class="bodyfooter-main-content-middle-rightside" style="width: 20%; height: 50px; text-align: right; color: #0000FF;"><hr style="height:1px;border:none;color:#333;background-color:#333;" />{{ $total }}<hr style="height:1px;border:none;color:#333;background-color:#333;" /></div>
                    </div>
                </div>
                <div class="body-main-content-middle">
                    <div class="toogletips-main-content-middle"  style="height: 50px;">
                        <div class="toogletips-main-content-middle-leftside" style="width: 80%; height: 30px; line-height: 30px;">Perhitungan</div>
                        <div class="toogletips-main-content-middle-leftside" style="width: 20%; height: 30px; line-height: 30px;"></div>
                    </div>
                    <div class="bodycontent-main-content-middle"  style="height: 50px;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">Pendapatan Masuk:</div>
                        <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px;"></div>
                    </div>
                    <div class="bodytable-main-content-middle" style="height: auto;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-rightside" style="width: 95% height: 50px;">
                            <table id="table-pendapatan" style="width: 100%;">
                                <tr style="text-align: center;">
                                    <th style="height: 30px; width: 50px; padding-bottom: 2%;">No.</th>
                                    <th style="height: 30px; width: 100px; padding-bottom: 2%;">Status</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">No Invoice</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Customer Name</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Customer Phone</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Subtotal</th>
                                </tr>
                                <tr>
                                    <?php $i = 1; ?>
                                    @forelse ($order_history_selesai as $val)
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $i++ }}</td>
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $val->status }}</td>
                                    <td style="text-align: left; font-family: 'Nunito Sans', sans-serif;">{{ $val->invoice }}</td>
                                    <td style="text-align: left; font-family: 'Nunito Sans', sans-serif;">{{ $val->customer_name }}</td>
                                    <td style="text-align: right; font-family: 'Nunito Sans', sans-serif;">{{ $val->customer_phone }}</td>
                                    <td style="text-align: right; font-family: 'Nunito Sans', sans-serif;">{{ $val->subtotal }}</td>
                                </tr>
                                <tr>
                                    @empty
                                </tr>
                                @endforelse
                            </table>
                            <div class="bodycontent-main-content-middle"  style="height: 50px; margin-top: 2%; margin-bottom: 2%;">
                                <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                                <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">{{ $order_history_selesai->links() }}</div>
                                <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px; text-align: center; color: #0000FF;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bodyfooter-main-content-middle" style="margin-bottom: 5%;">
                        <div class="bodfooter-main-content-middle-leftside" style="width: 10%; height: 50px; line-height: 50px;">
                        </div>
                        <div class="bodyfooter-main-content-middle-center" style="width: 70%; height: 50px; line-height: 50px; color: #0000FF;">Total Pendapatan Masuk: </div>
                        <div class="bodyfooter-main-content-middle-rightside" style="width: 20%; height: 50px; text-align: right; color: #0000FF;"><hr style="height:1px;border:none;color:#333;background-color:#333;" />{{ $total_selesai }}<hr style="height:1px;border:none;color:#333;background-color:#333;" /></div>
                    </div>
                    <div class="bodycontent-main-content-middle"  style="height: 50px;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">Pendapatan Hutang:</div>
                        <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px;"></div>
                    </div>
                    <div class="bodytable-main-content-middle" style="height: auto;">
                        <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                        <div class="body-main-content-middle-rightside" style="width: 95% height: 50px;">
                            <table id="table-pendapatan" style="width: 100%;">
                                <tr style="text-align: center;">
                                    <th style="height: 30px; width: 50px; padding-bottom: 2%;">No.</th>
                                    <th style="height: 30px; width: 100px; padding-bottom: 2%;">Status</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">No Invoice</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Customer Name</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Customer Phone</th>
                                    <th style="height: 30px; width: 300px; padding-bottom: 2%;">Subtotal</th>
                                </tr>
                                <tr>
                                    <?php $i = 1; ?>
                                    @forelse ($order_history_proses as $val)
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $i++ }}</td>
                                    <td style="text-align: center; font-family: 'Nunito Sans', sans-serif;">{{ $val->status }}</td>
                                    <td style="text-align: left; font-family: 'Nunito Sans', sans-serif;">{{ $val->invoice }}</td>
                                    <td style="text-align: left; font-family: 'Nunito Sans', sans-serif;">{{ $val->customer_name }}</td>
                                    <td style="text-align: right; font-family: 'Nunito Sans', sans-serif;">{{ $val->customer_phone }}</td>
                                    <td style="text-align: right; font-family: 'Nunito Sans', sans-serif;">{{ $val->subtotal }}</td>
                                </tr>
                                <tr>
                                    @empty
                                </tr>
                                @endforelse
                            </table>
                            <div class="bodycontent-main-content-middle"  style="height: 50px; margin-top: 2%; margin-bottom: 2%;">
                                <div class="body-main-content-middle-leftside" style="width: 5%; height: 50px;"></div>
                                <div class="body-main-content-middle-center" style="width: 65%; height: 50px; font-weight: bold; color: #0000FF;">{{ $order_history_proses->links() }}</div>
                                <div class="body-main-content-middle-rightside" style="width: 30%; height: 50px; text-align: center; color: #0000FF;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bodyfooter-main-content-middle" style="margin-bottom: 5%;">
                        <div class="bodfooter-main-content-middle-leftside" style="width: 10%; height: 50px; line-height: 50px;">
                        </div>
                        <div class="bodyfooter-main-content-middle-center" style="width: 70%; height: 50px; line-height: 50px; color: #0000FF;">Total Pendapatan Hutang: </div>
                        <div class="bodyfooter-main-content-middle-rightside" style="width: 20%; height: 50px; text-align: right; color: #0000FF;"><hr style="height:1px;border:none;color:#333;background-color:#333;" />{{ $total_proses }}<hr style="height:1px;border:none;color:#333;background-color:#333;" /></div>
                    </div>
                    <div class="toogletips-main-content-middle"  style="height: 50px;">
                        <div class="toogletips-main-content-middle-leftside" style="width: 80%; height: 30px; line-height: 30px;"><strong> Total Pendapatan Usaha ...</strong></div>
                        <div class="toogletips-main-content-middle-leftside" style="width: 20%; height: 30px; line-height: 30px; text-align: right;">Rp. {{ $total }}</div>
                    </div>
                    <div class="toogletips-main-content-middle"  style="height: 50px;">
                        <div class="toogletips-main-content-middle-leftside" style="width: 80%; height: 30px; line-height: 30px;"><strong> Total Pendapatan Masuk ...</strong></div>
                        <div class="toogletips-main-content-middle-leftside" style="width: 20%; height: 30px; line-height: 30px; text-align: right;">Rp. {{ $total_selesai }}</div>
                    </div>
                    <div class="toogletips-main-content-middle"  style="height: 50px;">
                        <div class="toogletips-main-content-middle-leftside" style="width: 80%; height: 30px; line-height: 30px;"><strong> Total Pendapatan Hutang ...</strong></div>
                        <div class="toogletips-main-content-middle-leftside" style="width: 20%; height: 30px; line-height: 30px; text-align: right;">Rp. {{ $total_proses }}</div>
                    </div>
                </div>

                <div class="footer-main-content-middle">
                    <div class="footer-main-content-middle-leftside" style="width: 20%; height: 50px;  line-height: 50px;"></div>
                    <div class="footer-main-content-middle-leftside" style="width: 60%; height: 50px;  line-height: 50px; text-align: center;">Export to: </div>
                    <div class="footer-main-content-middle-rightside" style="width: 20%; height: 50px; line-height: 50px;"></div>
                </div>
                <div class="footer-main-content-middle">
                    <div class="footer-main-content-middle-leftside" style="width: 20%; height: 50px;  line-height: 50px;"></div>
                    <div class="footer-main-content-middle-leftside" style="width: 60%; height: 50px;  line-height: 50px; text-align: center;">
                    <div class="footerbutton-main-content-middle">
                        <button class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</button>
                        <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                    </div>
                    </div>
                    <div class="footer-main-content-middle-rightside" style="width: 20%; height: 50px; line-height: 50px;"></div>
                </div>
            </div>
            <div class="main-content-right" style="width: 25%;">
            </div>
        </div>
    </div>

    <div class="container-wrapper">
        <div class="footer-content">
            <div class="footer-content-left" style="width: 25%;">
            </div>
            <div class="footer-content-center" style="width: 50%;">
                <div class="footer-content-sign">
                    <div class="footer-content-header">
                        <h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 13px; font-weight: bold; text-shadow: 0 1px 0 white;">© 2021 {{ env('APP_NAME') }}. All rights reserved.</h2>
                    </div>
                    <div class="footer-content-end" style="justify-content: center; align-items: center; text-align: center;">
                        <span style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 11px; font-weight: bold; text-shadow: 0 1px 0 white;">Bantul City, D.I Yogyakarta</span><br />
                        <span style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 11px; font-weight: bold; text-shadow: 0 1px 0 white;">Koperasi Pondok</span>
                    </div>
                </div>
            </div>
            <div class="footer-content-right" style="width: 25%;">
            </div>
        </div>
    </div>


</body>
</html>
