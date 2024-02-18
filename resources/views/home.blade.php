@extends('layouts.main')
@section('layouts.content')

<body>
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">PT. Surabaya Autocomp Indonesia
            </h2>
        </div>
        <ul>
            <p style="margin-top: 15pt;">Silakan baca petunjuk berikut sebelum menggunakan : </p>
            <figcaption class="blockquote-footer">
                klik gambar <cite title="Source Title">untuk membaca lebih detail</cite>
            </figcaption>

            <table class="table table-bordered" style="width: 1010px;">
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ url('update_database') }}">
                                <img src="{{ asset('dist/img/update-database.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Update Database : </span> berisi data Master Price dan Master UMH dari departemen FA, serta Data Circuit Single, Circuit Non-single, dan Data Buppin dari departemen DE. </p>
                            Template Update Database.
                            <br><a href="{{ asset('assets/template/Circuit Single.xlsx') }}">1. Circuit Single</a><br>
                            <a href="{{ asset('assets/template/Circuit Non Single.xlsx') }}">2. Circuit Non
                                Single</a><br>
                            <a href="{{ asset('assets/template/Data Buppin.xlsx') }}">3. Data Buppin</a><br>
                            <a href="{{ asset('assets/template/Master Price.xlsx') }}">4. Master Price</a><br>
                            <a href="{{ asset('assets/template/Master UMH.xlsx') }}">5. Master UMH</a>
                            <br><br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunggah data,
                                pastikan bahwa nama kolom pada judul sesuai dengan template, dan pastikan bahwa file
                                Excel tidak mengalami freeze pada sel-selnya.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('hasil_sto') }}">
                                <img src="{{ asset('dist/img/hasil-sto.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Hasil STO : </span> berisi data dari departemen produksi
                                yaitu Data Final Assy dan Pre Assy.</p>
                            Template Data Produksi
                            <br><a href="{{ asset('assets/template/Final Assy Produksi.xlsx') }}">1. Final Assy</a><br>
                            <a href="{{ asset('assets/template/Pre Assy Produksi.xlsx') }}">2. Pre Assy</a>
                            <br><br><p style="color:red;"><span style="font-weight: 600;">NB </span> Sebelum mengunggah data,
                                pastikan bahwa nama kolom pada judul sesuai dengan template, dan pastikan bahwa file
                                Excel tidak mengalami freeze pada sel-selnya.</p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('report_hasil') }}">
                            <img src="{{ asset('dist/img/report.png') }}" alt="" style="width: 13rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Report </span> digunakan untuk mengunduh summary cost
                                dari pre assy dan final assy dan juga total QTY dari setiap bupinnya.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('data_profile') }}">
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