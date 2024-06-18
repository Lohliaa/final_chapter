@extends('layouts.main')
@section('layouts.content')

<body>
    <div class="card shadow mt-2">
        <div class="card-header py-3 bg-primary text-white">
            <h2 class="m-0 font-weight-bold text-center">SISTEM INFORMASI PERHITUNGAN WIP PADA PRODUCTION AMOUNT PT. XYZ</h2>
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
                            <p><span style="font-weight: 600;">Update Database </span> berisi data Data Harga dan Data UMH dari Departemen Keuangan, serta Data Properti Single, Properti Non-single, dan Data Item dari Departemen Desain. </p>
                            Template Update Database.
                            <br><a href="{{ asset('assets/template/Properti Single.xlsx') }}">1. Properti Single</a><br>
                            <a href="{{ asset('assets/template/Properti Non Single.xlsx') }}">2. Properti Non Single</a><br>
                            <a href="{{ asset('assets/template/Data Item.xlsx') }}">3. Data Item</a><br>
                            <a href="{{ asset('assets/template/Data Harga.xlsx') }}">4. Data Harga</a><br>
                            <a href="{{ asset('assets/template/Data UMH.xlsx') }}">5. Data UMH</a>
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

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('hasil_sto') }}">  --}}
                                <img src="{{ asset('dist/img/hasil-sto.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Hasil STO </span> berisi Data Area Final dan Area Preparation.</p>
                            Template Hasil STO
                            <br><a href="{{ asset('assets/template/Area Final.xlsx') }}">1. Area Final</a><br>
                            <a href="{{ asset('assets/template/Area Preparation.xlsx') }}">2. Area Preparation</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('report_hasil') }}">  --}}
                            <img src="{{ asset('dist/img/report.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report </span> digunakan untuk mengunduh hasil rekapitulasi perhitungan biaya dan jumlah properti
                                dari area preparation dan area final</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{--  <a href="{{ url('data_profile') }}">  --}}
                            <img src="{{ asset('dist/img/profile.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Kelola Akun </span> digunakan untuk admin mengelola akun yang login ke sistem.
                        </td>
                    </tr>
                </tbody>
            </table>
        </ul>
    </div>
</body>

@endsection