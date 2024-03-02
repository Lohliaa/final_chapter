@extends('layouts.main')
@section('layouts.content')

<body>
    <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center">PT. XXX
            </h2>
        </div>
        <ul>
            <p style="margin-top: 15pt; font-size:18pt;">Petunjuk Penggunaan </p>
            <figcaption class="blockquote-footer">
                klik icon plus (+) <cite title="Source Title">untuk membaca lebih detail</cite>
            </figcaption>

            <div class="container p-2">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: gainsboro">
                            <h3 class="card-title">Circuit Single</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(1)">
                                    <i id="collapseIcon1" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard1">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/circuit-single.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/circuit-single.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Circuit Single : </span> berisi data
                                                circuit single dari
                                                departemen DE yang digunakan untuk melengkapi properties.</p>
                                            <p><span style="font-weight: 600;">Circuit Single </span> memiliki beberapa
                                                fitur seperti:</p>
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 70pt;">
                                                <img src="{{ asset('dist/img/tambah.png') }}" alt=""
                                                    style="width: 6rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Tambah : </span> digunakan untuk
                                                menambahkan data secara manual yaitu secara satu per satu.</p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit single</li>
                                                <li>2. Klik buttons "Tambah" </li>
                                                <li>3. Masukkan Data</li>
                                                <li>4. Pastikan pada kolom C/L-28 data berupa angka</li>
                                                <li>5. Klik buttons "Simpan" untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 4rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit
                                                data.</p>
                                            <p>Cara untuk edit data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit single</li>
                                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                                <li>3. Klik buttons "Edit" </li>
                                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                                    "Simpan"
                                                    untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/upload.png') }}" alt=""
                                                    style="width: 8rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Upload Excel : </span>digunakan untuk
                                                mengunggah data circuit single secara keseluruhan dalam bentuk file
                                                Excel.
                                            </p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data circuit single yang telah sesuai dengan format
                                                    template
                                                    Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman circuit single</li>
                                                <li>3. Klik buttons "Upload"</li>
                                            </ul>
                                            <p><span style="font-weight: 600;">NB : </span> Template dapat diunduh di
                                                halaman utama</p>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/download.png') }}" alt=""
                                                    style="width: 10rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Download Excel : </span>digunakan untuk
                                                mengunduh data circuit single secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit single</li>
                                                <li>2. Klik buttons "Download Excel". Browser akan langsung mengunduh
                                                    file
                                                    dalam
                                                    bentuk excel</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/delete.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                                menghapus data.</p>
                                            <p>Cara untuk menghapus data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit single</li>
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
                                                <img src="{{ asset('dist/img/reset.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk menghapus semua data.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/refresh.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Refresh : </span> digunakan untuk memuat ulang halaman.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 40pt;">
                                                <img src="{{ asset('dist/img/cari.png') }}" alt=""
                                                    style="width: 15rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                                data yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan
                                                </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno
                                                    saja</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: gainsboro">
                            <h3 class="card-title">Circuit Non-Single</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(2)">
                                    <i id="collapseIcon2" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/non-single.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/non-single.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Circuit Non Single : </span> berisi data
                                                circuit non single dari departemen DE yang digunakan untuk melengkapi
                                                properties. </p>
                                            <p><span style="font-weight: 600;">Circuit Non Single </span> memiliki
                                                beberapa fitur seperti: </p>
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 70pt;">
                                                <img src="{{ asset('dist/img/tambah.png') }}" alt=""
                                                    style="width: 6rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Tambah : </span> digunakan untuk
                                                menambahkan data secara manual yaitu secara satu per satu.</p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit non single</li>
                                                <li>2. Klik buttons "Tambah" </li>
                                                <li>3. Masukkan Data</li>
                                                <li>4. Pastikan pada kolom CL data berupa angka</li>
                                                <li>5. Klik buttons "Simpan" untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 4rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit
                                                data.</p>
                                            <p>Cara untuk edit data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit non single</li>
                                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                                <li>3. Klik buttons "Edit" </li>
                                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                                    "Simpan"
                                                    untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/upload.png') }}" alt=""
                                                    style="width: 8rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Upload Excel : </span>digunakan untuk
                                                mengunggah data circuit non single secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data circuit non single yang telah sesuai dengan format
                                                    template Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman circuit non single</li>
                                                <li>3. Klik buttons "Upload"</li>
                                            </ul>
                                            <p><span style="font-weight: 600;">NB : </span> Template dapat diunduh di
                                                halaman utama</p>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/download.png') }}" alt=""
                                                    style="width: 10rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Download Excel : </span>digunakan untuk
                                                mengunduh data circuit non single secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit non single</li>
                                                <li>2. Klik buttons "Download Excel". Browser akan langsung mengunduh
                                                    file
                                                    dalam
                                                    bentuk excel</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/delete.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                                menghapus data.</p>
                                            <p>Cara untuk menghapus data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman circuit non single</li>
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
                                                <img src="{{ asset('dist/img/reset.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk menghapus semua data</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/refresh.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Refresh : </span> digunakan untuk memuat ulang halaman.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/cari.png') }}" alt=""
                                                    style="width: 15rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                                data yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno saja</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: gainsboro">
                            <h3 class="card-title">Data Buppin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(3)">
                                    <i id="collapseIcon3" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard3">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/buppin.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/buppin.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Data Buppin : </span> yaitu berisi data
                                                buppin dari seluruh carline.</p>
                                            <p><span style="font-weight: 600;">Data Buppin </span> memiliki beberapa
                                                fitur seperti:</p>
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 70pt;">
                                                <img src="{{ asset('dist/img/tambah.png') }}" alt=""
                                                    style="width: 6rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Tambah : </span> digunakan untuk
                                                menambahkan data secara manual yaitu secara satu per satu.</p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman data buppin</li>
                                                <li>2. Klik buttons "Tambah" </li>
                                                <li>3. Masukkan Data</li>
                                                <li>4. Klik buttons "Simpan" untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 4rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit
                                                data.</p>
                                            <p>Cara untuk edit data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Data Buppin</li>
                                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                                <li>3. Klik buttons "Edit" </li>
                                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                                    "Simpan"
                                                    untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/upload.png') }}" alt=""
                                                    style="width: 8rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Upload Excel : </span>digunakan untuk
                                                mengunggah data buppin secara keseluruhan dalam bentuk file Excel.</p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data buppin yang telah sesuai dengan format template
                                                    Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman Data Buppin</li>
                                                <li>3. Klik buttons "Upload"</li>
                                            </ul>
                                            <p><span style="font-weight: 600;">NB : </span> Template dapat diunduh di
                                                halaman utama</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/download.png') }}" alt=""
                                                    style="width: 10rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Download Excel : </span>digunakan untuk
                                                mengunduh data buppin secara keseluruhan dalam bentuk file Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Data Buppin</li>
                                                <li>2. Klik buttons "Download Excel". Browser akan langsung mengunduh
                                                    file
                                                    dalam bentuk excel</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/delete.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                                menghapus data.</p>
                                            <p>Cara untuk menghapus data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Data Buppin</li>
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
                                                <img src="{{ asset('dist/img/reset.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk menghapus semua data.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/refresh.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Refresh : </span> digunakan untuk memuat ulang halaman.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/cari.png') }}" alt=""
                                                    style="width: 15rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                                data yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno saja</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: gainsboro">
                            <h3 class="card-title">Master Price</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(4)">
                                    <i id="collapseIcon4" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/master-price.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/master-price.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Master Price : </span> yaitu berisi price
                                                dari seluruh data buppin </p>
                                            <p><span style="font-weight: 600;">Master Price </span> memiliki beberapa
                                                fitur seperti:</p>
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 70pt;">
                                                <img src="{{ asset('dist/img/tambah.png') }}" alt=""
                                                    style="width: 6rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Tambah : </span> digunakan untuk
                                                menambahkan data secara manual yaitu secara satu per satu </p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master Price</li>
                                                <li>2. Klik buttons "Tambah" </li>
                                                <li>3. Masukkan Data</li>
                                                <li>4. Klik buttons "Simpan" untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 4rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit
                                                data.</p>
                                            <p>Cara untuk edit data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master Price</li>
                                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                                <li>3. Klik buttons "Edit" </li>
                                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                                    "Simpan"
                                                    untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/upload.png') }}" alt=""
                                                    style="width: 8rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Upload Excel : </span>digunakan untuk
                                                mengunggah data master price secara keseluruhan dalam bentuk file Excel.
                                            </p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data master price yang telah sesuai dengan format
                                                    template
                                                    Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman Master Price</li>
                                                <li>3. Klik buttons "Upload"</li>
                                                <p><span style="font-weight: 600;">NB : </span> Template dapat diunduh
                                                    di
                                                    halaman utama</p>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/download.png') }}" alt=""
                                                    style="width: 10rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Download Excel : </span>digunakan untuk
                                                mengunduh data master price secara keseluruhan dalam bentuk file Excel.
                                            </p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master Price</li>
                                                <li>2. Klik buttons "Download Excel". Browser akan langsung mengunduh
                                                    file
                                                    dalam
                                                    bentuk excel</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/delete.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                                menghapus data.</p>
                                            <p>Cara untuk menghapus data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master Price</li>
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
                                                <img src="{{ asset('dist/img/reset.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk menghapus semua data.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/refresh.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Refresh : </span> digunakan untuk memuat ulang halaman.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/cari.png') }}" alt=""
                                                    style="width: 15rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                                data yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan
                                                </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno saja</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: gainsboro">
                            <h3 class="card-title">Master UMH</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(5)">
                                    <i id="collapseIcon5" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard5">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/master-umh.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/master-umh.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Master UMH : </span> yaitu berisi price
                                                yang digunakan untuk menghitung process cost dari setiap carline </p>
                                            <p><span style="font-weight: 600;">Master UMH </span> memiliki beberapa
                                                fitur seperti:</p>
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 70pt;">
                                                <img src="{{ asset('dist/img/tambah.png') }}" alt=""
                                                    style="width: 6rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Tambah : </span> digunakan untuk
                                                menambahkan data secara manual yaitu secara satu per satu</p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master UMH</li>
                                                <li>2. Klik buttons "Tambah" </li>
                                                <li>3. Masukkan Data</li>
                                                <li>4. Klik buttons "Simpan" untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/edit.png') }}" alt="" style="width: 4rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Edit : </span> digunakan untuk mengedit
                                                data.</p>
                                            <p>Cara untuk edit data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master UMH</li>
                                                <li>2. Centang checkbox pada data yang akan diedit</li>
                                                <li>3. Klik buttons "Edit" </li>
                                                <li>4. Setelah masuk ke halaman edit dan telah mengedit data. Klik
                                                    "Simpan"
                                                    untuk menyimpan data</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/upload.png') }}" alt=""
                                                    style="width: 8rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Upload Excel : </span>digunakan untuk
                                                mengunggah data master umh secara keseluruhan dalam bentuk file Excel.
                                            </p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data master umh yang telah sesuai dengan format template
                                                    Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman Master UMH</li>
                                                <li>3. Klik buttons "Upload"</li>
                                            </ul>
                                            <p><span style="font-weight: 600;">NB : </span> Template dapat diunduh di
                                                halaman utama</p>
                                            </p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/download.png') }}" alt=""
                                                    style="width: 10rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Download Excel : </span>digunakan untuk
                                                mengunduh data master umh secara keseluruhan dalam bentuk file Excel.
                                            </p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master UMH</li>
                                                <li>2. Klik buttons "Download Excel". Browser akan langsung mengunduh
                                                    file
                                                    dalam
                                                    bentuk excel</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 60pt;">
                                                <img src="{{ asset('dist/img/delete.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Delete : </span> digunakan untuk
                                                menghapus data.</p>
                                            <p>Cara untuk menghapus data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Master UMH</li>
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
                                                <img src="{{ asset('dist/img/reset.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk menghapus semua data.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/refresh.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Refresh : </span> digunakan untuk memuat ulang halaman.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center; margin-top: 50pt;">
                                                <img src="{{ asset('dist/img/cari.png') }}" alt=""
                                                    style="width: 15rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Cari : </span> digunakan untuk mencari
                                                data yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <li>1. Cari data secara manual yaitu dengan mengetikkan data yang dibutuhkan
                                            </li>
                                            <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                ctrlno
                                                saja</li>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</body>
<script>
    function toggleCardCollapse(cardNumber) {
      $('#collapseCard' + cardNumber).collapse('toggle');
      var collapseIcon = $('#collapseIcon' + cardNumber);
    
      if (collapseIcon.hasClass('fa-plus')) {
        collapseIcon.removeClass('fa-plus');
        collapseIcon.addClass('fa-minus');
      } else {
        collapseIcon.removeClass('fa-minus');
        collapseIcon.addClass('fa-plus');
      }
    }
</script>

@endsection