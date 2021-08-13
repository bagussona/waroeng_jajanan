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
            height: 297mm;
            width: 210mm;
        /* to centre page on screen*/
            padding-right: 2%;
            margin-left: auto;
            margin-right: auto;
            -webkit-text-size-adjust: none;
            font-family: 'Nunito', sans-serif;
            color: #51545E;
        }

    </style>
</head>
<body>
    <div class="container-wrapper">
        <table>
            <tr>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
            </tr>
            <tr>
                <td style="width: 99.2125px; height: 50px; background-color: #F4F4F7;"></td>
                <td style="width: 99.2125px; height: 50px; background-color: #F4F4F7;"></td>
                <td colspan="3" style="height: 50px; background-color: #F4F4F7; text-align: center;">
                    <a style="text-decoration: none;" href="{{ route('front.index') }}"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 20px; font-weight: bold; text-shadow: 0 1px 0 white; text-align: center; line-height: 50px;">{{ env('APP_NAME') }}</h2></a>
                </td>
                <td style="width: 99.2125px; height: 50px; background-color: #F4F4F7;"></td>
                <td style="width: 99.2125px; height: 50px; background-color: #F4F4F7;"></td>
            </tr>
            <tr>
                <td colspan="5" style="height: 75px;">Akhiri Shift, <small>{{ Auth::user()->name }}</small></td>
                <td colspan="2" style="height: 75px; text-align: right;"><small>Tanggal: {{ date('Y-m-d') }} </small></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" style="border-top: double;"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7" style="height: 25px;"></td>
            </tr>
            <tr>
                <td colspan="6" style="height: 50px;">Pendapatan</td>
                <td style="height: 50px;">Saldo</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 50px; text-align: center; color: #0000FF;">Pendapatan Usaha</td>
                <td colspan="3" style="height: 50px;"></td>
                <td colspan="2" style="height: 50px; text-align: center; border-top: solid 1px black; color: #0000FF;">IDR</td>
            </tr>
            <tr>
                <td colspan="7">
                <table>
                    <tr>
                        <th style="height: 50px; width: 25px;"></th>
                        <th style="height: 50px; width: 75px; text-align: center;">No.</th>
                        <th style="height: 50px; width: 375px; text-align: left;">Produk yang terjual hari ini..</th>
                        <th style="height: 50px; width: 75px; text-align: center;">Qty</th>
                        <th style="height: 50px; width: 150px; text-align: center;">Subtotal</th>
                        <th style="height: 50px; width: 25px;"></th>
                    </tr>
                    <tr>
                        <?php $i = 1; ?>
                        @forelse ($order_all as $val)
                        <td style="height: 30px;"></td>
                        <td style="font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px; text-align: center;">{{ $i++ }}</td>
                        <td style="font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px; text-align: left;">{{ $val->products }}</td>
                        <td style="font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px; text-align: center;">{{ $val->terjual }}</td>
                        <td style="font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px; text-align: right;">{{ $val->subtotal }}</td>
                        <td style="height: 30px;"></td>
                    </tr>
                    <tr>
                        @empty
                        <td colspan="6" style="height: 50px;"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 20px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 0;">Belum ada yang terjual hari ini..</h2></td>
                    </tr>
                    @endforelse
                </table>
            </td>
            </tr>
            <tr>
                <td style="height: 50px;"></td>
                <td colspan="4" style="height: 50px; color: #0000FF;">Total Pendapatan Usaha: </td>
                <td colspan="2" style="height: 50px; text-align: right; border-top: solid 1px black; border-bottom: solid 1px black; color: #0000FF;">{{ $total }}</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 25px;"></td>
            </tr>
            <tr>
                <td colspan="7" style="height: 50px;">Perhitungan</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 50px; text-align: center; color: #0000FF;">Pendapatan Masuk</td>
                <td colspan="5" style="height: 50px;"></td>
            </tr>
            <tr>
                <td colspan="7">
                    <table>
                        <tr>
                            <th style="height: 50px; width: 50px; text-align: center;">No.</th>
                            <th style="height: 50px; width: 75px; text-align: center;">Status</th>
                            <th style="height: 50px; width: 150px; text-align: center;">No Invoice</th>
                            <th style="height: 50px; width: 200px; text-align: left;">Customer Name</th>
                            <th style="height: 50px; width: 100px; text-align: center;">Phone</th>
                            <th style="height: 50px; width: 125px; text-align: center;">Subtotal</th>
                        </tr>
                        <tr>
                            <?php $i = 1; ?>
                            @forelse ($order_history_selesai as $value)
                            <td style="text-align: center; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $i++ }}</td>
                            <td style="text-align: center; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $value->status }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $value->invoice }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $value->customer_name }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $value->customer_phone }}</td>
                            <td style="text-align: right; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $value->subtotal }}</td>
                        </tr>
                        <tr>
                            @empty
                            <td colspan="6" style="height: 50px;"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 20px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 0;">Belum ada pendapatan masuk hari ini..</h2></td>
                        </tr>
                        @endforelse
                    </table>
                </td>
            </tr>
            <tr>
                <td style="height: 50px;"></td>
                <td colspan="4" style="height: 50px; color: #0000FF;">Total Pendapatan Masuk: </td>
                <td colspan="2" style="height: 50px; text-align: right; border-top: solid 1px black; border-bottom: solid 1px black; color: #0000FF;">{{ $total_selesai }}</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 25px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="height: 50px; text-align: center; color: #0000FF;">Pendapatan Hutang</td>
                <td colspan="5" style="height: 50px;"></td>
            </tr>
            <tr>
                <td colspan="7">
                    <table>
                        <tr>
                            <th style="height: 50px; width: 50px; text-align: center;">No.</th>
                            <th style="height: 50px; width: 75px; text-align: center;">Status</th>
                            <th style="height: 50px; width: 150px; text-align: center;">No Invoice</th>
                            <th style="height: 50px; width: 200px; text-align: left;">Customer Name</th>
                            <th style="height: 50px; width: 100px; text-align: center;">Phone</th>
                            <th style="height: 50px; width: 125px; text-align: center;">Subtotal</th>
                        </tr>
                        <tr>
                            <?php $i = 1; ?>
                            @forelse ($order_history_proses as $q)
                            <td style="text-align: center; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $i++ }}</td>
                            <td style="text-align: center; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $q->status }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $q->invoice }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $q->customer_name }}</td>
                            <td style="text-align: left; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $q->customer_phone }}</td>
                            <td style="text-align: right; font-family: 'Nunito Sans', sans-serif; font-size: 14px; height: 30px;">{{ $q->subtotal }}</td>
                        </tr>
                        <tr>
                            @empty
                            <td colspan="6" style="height: 50px;"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 20px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 0;">Belum ada pendapatan hutang hari ini..</h2></td>
                        </tr>
                        @endforelse
                    </table>
                </td>
            </tr>
            <tr>
                <td style="height: 50px;"></td>
                <td colspan="4" style="height: 50px; color: #0000FF;">Total Pendapatan Hutang: </td>
                <td colspan="2" style="height: 50px; text-align: right; border-top: solid 1px black; border-bottom: solid 1px black; color: #0000FF;">{{ $total_proses }}</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 50px;"></td>
            </tr>
            <tr>
                <td colspan="5">Total Pendapatan Usaha : </td>
                <td colspan="2" style="text-align: right;">Rp. {{ $total }}</td>
            </tr>
            <tr>
                <td colspan="5">Total Pendapatan Masuk : </td>
                <td colspan="2" style="text-align: right;">Rp. {{ $total_selesai }}</td>
            </tr>
            <tr>
                <td colspan="5">Total Pendapatan Hutang : </td>
                <td colspan="2" style="text-align: right;">Rp. {{ $total_proses }}</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 25px;"></td>
            </tr>
            <tr>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
                <th style="width: 99.2125px; background-color: #F4F4F7;"></th>
            </tr>
            <tr>
                <td style="width: 99.2125px; height: 75px; background-color: #F4F4F7;"></td>
                <td style="width: 99.2125px; height: 75px; background-color: #F4F4F7;"></td>
                <td colspan="3" style="height: 75px; background-color: #F4F4F7; text-align: center;">
                    <a style="text-decoration: none;" href="{{ route('front.index') }}"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 13px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 5px;">© 2021 {{ env('APP_NAME') }}. All rights reserved.</h2></a>
                    <a style="text-decoration: none;" href="#"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 11px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 5px;">Bantul City, DI Yogyakarta</h2></a>
                    <a style="text-decoration: none;" href="#"><h2 style="text-align: center; color: #A8AAAF; font-family: 'Nunito', sans-serif; font-size: 11px; font-weight: bold; text-shadow: 0 1px 0 white; margin: 5px;">Koperasi Pondok</h2></a>
                </td>
                <td style="width: 99.2125px; height: 75px; background-color: #F4F4F7;"></td>
                <td style="width: 99.2125px; height: 75px; background-color: #F4F4F7;"></td>
            </tr>

        </table>
    </div>
</body>
</html>
