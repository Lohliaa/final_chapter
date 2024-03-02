@extends('layouts.main')
@section('layouts.content')

<body>
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">PT. XXX
            </h2>
        </div>
        <ul>
            <p style="margin-top: 15pt;">Petunjuk Penggunaan : </p>
            
            <table class="table table-bordered" style="width: 1010px;">
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ asset('dist/img/report-hasil.png') }}" target="_blank">
                                <img src="{{ asset('dist/img/report-hasil.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report : </span> digunakan untuk mengunduh summary cost
                                dari pre assy dan final assy dan juga total QTY dari setiap bupinnya. </p>
                            Terdapat 3 macam jenis report, yaitu:
                            <ul>
                                <li>Report Hasil STO</li>
                                <li>Report QTY Perconveyor</li>
                                <li>Report QTY All Conveyor</li>
                            </ul>
                            <br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunduh summary amount atau summary qty pastikan sudah melakukan Proses Hasil STO baik dari Final Assy maupun Pre Assy</p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('dist/img/report-amount.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report Amount</span> digunakan untuk mengunduh summary cost dari proses Hasil STO baik dari Final Assy maupun Pre Assy.</p>
                            <p>Report Amount menghasilkan file dalam format excel yang memiliki 2 sheet, dimana masing-masing sheet memiliki hasil yang berbeda yaitu:
                                <ul>
                                    <li>Sheet 1 merupakan hasil dari summary cost hasil STO baik itu final assy maupun pre assy</li>
                                    <li>Sheet 2 merupakan total dari semua summary cost hasil STO berdasarkan masing-masing conveyor</li>
                                </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('dist/img/report-qty.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report QTY </span> digunakan untuk mengunduh QTY data buppin baik dari hasil sto Final Assy maupun Pre Assy.</p>
                            <p>Report QTY menghasilkan sebuah file dalam format Excel yang terdiri dari beberapa lembar (sheet), di mana setiap lembar berisi informasi mengenai conveyor yang berbeda-beda.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('dist/img/report-all.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report ALL </span> digunakan untuk mengunduh  seluruh QTY data buppin baik dari hasil sto Final Assy maupun Pre Assy.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </ul>
    </div>
</body>

@endsection