@extends('layouts.main')
@section('layouts.content')

<body>
    <div class="card shadow mt-2">
        <div class="card-header py-3 bg-primary text-white">
            <h2 class="m-0 font-weight-bold text-center">PT. XXX</h2>
        </div>
        
        <ul>
            <p style="margin-top: 15pt;">Silakan baca petunjuk berikut sebelum menggunakan : </p>
            <figcaption class="blockquote-footer mb-1">
                klik 
                <a href="{{ asset('assets/template/MANUAL BOOK WIP SYSTEM.pdf') }}" title="Manual Book">
                    untuk mendapatkan panduan penggunaan yang lebih detail
                </a>
            </figcaption>
            

            <table class="table table-bordered" style="width: 95%;">
                <tbody>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('update_database') }}">  --}}
                                <img src="{{ asset('dist/img/update-database(1).png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Update Database </span> berisi data Daftar Harga dan Daftar UMH dari Departemen Keuangan, serta Data Circuit Single, Circuit Non-single, dan Data Item dari Departemen Desain. </p>
                            Template Update Database.
                            <br><a href="{{ asset('assets/template/Circuit Single.xlsx') }}">1. Circuit Single</a><br>
                            <a href="{{ asset('assets/template/Circuit Non Single.xlsx') }}">2. Circuit Non Single</a><br>
                            <a href="{{ asset('assets/template/Data Buppin.xlsx') }}">3. Data Item</a><br>
                            <a href="{{ asset('assets/template/Master Price.xlsx') }}">4. Daftar Harga</a><br>
                            <a href="{{ asset('assets/template/Master UMH.xlsx') }}">5. Daftar UMH</a>
                            {{--  <br><br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunggah data,
                                pastikan bahwa nama kolom pada judul sesuai dengan template, dan pastikan bahwa file
                                Excel tidak mengalami freeze pada sel-selnya.</p>  --}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('hasil_sto') }}">  --}}
                                <img src="{{ asset('dist/img/material.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Material </span> berisi seluruh informasi mengenai item dari kedua area, yakni area final dan area preparation, yang akan dihitung total harganya.</p>
                            Template Material
                            <br><a href="{{ asset('assets/template/Database Konversi.xlsx') }}">1. Database Konversi</a><br>
                            <a href="{{ asset('assets/template/Material.xlsx') }}">2. Material</a>
                            {{--  <br><br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunggah data,
                                pastikan bahwa nama kolom pada judul sesuai dengan template, dan pastikan bahwa file
                                Excel tidak mengalami freeze pada sel-selnya.</p>  --}}

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('hasil_sto') }}">  --}}
                                <img src="{{ asset('dist/img/hasil-sto.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Hasil STO </span> berisi data dari Departemen Produksi
                                yaitu Data Area Final dan Area Preparation.</p>
                            Template Data Produksi
                            <br><a href="{{ asset('assets/template/Final Assy Produksi.xlsx') }}">1. Area Final</a><br>
                            <a href="{{ asset('assets/template/Pre Assy Produksi.xlsx') }}">2. Area Preparation</a>
                            {{--  <br><br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunggah data,
                                pastikan bahwa nama kolom pada judul sesuai dengan template, dan pastikan bahwa file
                                Excel tidak mengalami freeze pada sel-selnya.</p>  --}}

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('report_hasil') }}">  --}}
                            <img src="{{ asset('dist/img/report.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report </span> digunakan untuk mengunduh summary cost
                                dari area preparation dan area final dan juga total QTY dari setiap itemnya.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('data_profile') }}">  --}}
                            <img src="{{ asset('dist/img/profile.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Profile </span> digunakan untuk melihat akun yang sedang
                                login ke sistem.
                        </td>
                    </tr>
                </tbody>
            </table>
        </ul>
    </div>
</body>

@endsection