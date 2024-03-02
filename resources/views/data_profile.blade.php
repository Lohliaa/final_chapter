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
                            <a href="{{ asset('dist/img/data-profile.png') }}" target="_blank">
                                <img src="{{ asset('dist/img/data-profile.png') }}" alt="" style="width: 25rem;">
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Profile : </span> digunakan untuk melihat akun yang
                                sedang login ke sistem.</p>
                            <p>Halaman profil hanya dapat diakses oleh akun yang memiliki peran sebagai admin.</p>
                            <p>Admin dapat mengubah dan menghapus data profile yang sedang login ke sistem.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center; margin-top: 60pt;">
                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 5rem;">
                            </div>
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit data pada
                                masing-masing profile yang sedang login.</p>
                            <p>Cara untuk edit data yaitu : </p>
                            <ul>
                                <li>1. Masuk ke Halaman Profile</li>
                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                <li>3. Klik buttons "Edit" </li>
                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                    "Simpan" untuk menyimpan data</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center; margin-top: 60pt;">
                                <img src="{{ asset('dist/img/delete.png') }}" alt="" style="width: 5rem;">
                            </div>
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                menghapus data profile yang sedang login.</p>
                            <p>Cara untuk menghapus data yaitu : </p>
                            <ul>
                                <li>1. Masuk ke Halaman Profile</li>
                                <li>2. Centang checkbox pada data yang akan dihapus</li>
                                <li>3. Klik buttons "Hapus" </li>
                                <li>4. Setelah klik buttons hapus, akan muncul pesan untuk memastikan
                                    <span style="font-weight: 600;">"apakah yakin untuk menghapus data
                                        tersebut?"
                                    </span>
                                    <p> klik <span style="font-weight: 600;">"Ya"</span> jika ingin
                                        menghapus,
                                        dan
                                    <p> klik <span style="font-weight: 600;">"Tidak"</span> jika tidak
                                        ingin
                                        menghapus
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <img src="{{ asset('dist/img/reset.png') }}" alt="" style="width: 5rem;">
                            </div>
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk mengatur
                                ulang halaman.</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center; margin-top: 50pt;">
                                <img src="{{ asset('dist/img/cari.png') }}" alt="" style="width: 15rem;">
                            </div>
                        </td>
                        <td>
                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                data profile yang sedang dibutuhkan.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </ul>
    </div>
</body>

@endsection