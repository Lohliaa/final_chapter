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
                            <h3 class="card-title">HASIL STO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(1)">
                                    <i id="collapseIcon1" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard1">
                            <table class="table table-bordered" style="width: 1010px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/final-assy.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/final-assy.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Final Assy : </span> berisi data dari
                                                departemen produksi
                                                yang akan dilengkapi propertiesnya dan dihitung total amountnya</p>
                                            <p><span style="font-weight: 600;">Final Assy </span> memiliki beberapa
                                                fitur seperti:
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Proses Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/pre-assy.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/pre-assy.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Pre Assy : </span> berisi data dari
                                                departemen produksi
                                                yang akan dilengkapi propertiesnya dan dihitung total amountnya</p>
                                            <p><span style="font-weight: 600;">Pre Assy </span> memiliki beberapa
                                                fitur seperti:
                                            <ul>
                                                <li>Tambah Data</li>
                                                <li>Edit Data</li>
                                                <li>Upload Data</li>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Proses Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
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
                                                menambahkan
                                                data secara manual yaitu secara satu per satu</p>
                                            <p>Cara untuk tambah data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
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
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
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
                                                mengunggah data secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Upload Data yaitu : </p>
                                            <ul>
                                                <li>1. Siapkan data dari produksi yang telah disesuaikan dengan format
                                                    template
                                                    Excel untuk proses pengunggahan data.</li>
                                                <li>2. Masuk ke halaman Final Assy/Pre Assy</li>
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
                                                mengunduh data secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
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
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
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
                                                <img src="{{ asset('dist/img/buttons-proses.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Proses : </span> digunakan untuk proses
                                                melengkapi properties dengan menyesuaikan circuit single dan circuit
                                                non-single berdasarkan masing-masing ctrlno</p>
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
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk mengatur
                                                ulang halaman.</p>
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
                                                data
                                                yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan
                                                </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno
                                                    saja
                                                </li>
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
                            <h3 class="card-title">Proses Pre Assy/Final Assy</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(2)">
                                    <i id="collapseIcon2" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard2">
                            <table class="table table-bordered" style="width: 1010px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/proses.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/proses.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Proses Final Assy : </span> berisi data
                                                dari departemen produksi yang telah dilengkapi propertiesnya dengan menyesuaikan data dari
                                                circuit single dan circuit non single berdasarkan ctrlno.</p>
                                            <p><span style="font-weight: 600;">Proses Final Assy </span> memiliki
                                                beberapa fitur seperti:
                                            <ul>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Hitung Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
                                            <p><span style="font-weight: 600;">NB : </span>Perlu diketahui bahwa jika
                                                terdapat ctrlno yang tidak memiliki properties ketika masuk ke halaman
                                                process, hal ini menunjukkan bahwa ada ketidaksesuaian penulisan antara
                                                data dalam database Circuit Single atau Circuit Non-Single dengan data
                                                produksi. Sebagai hasilnya, ctrlno tidak dapat melengkapi propertinya.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/proses-pa.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/proses-pa.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Proses Pre Assy : </span> berisi data
                                                dari departemen produksi yang telah dilengkapi propertiesnya dengan menyesuaikan data dari
                                                circuit single dan circuit non single berdasarkan ctrlno.</p>
                                            <p><span style="font-weight: 600;">Proses Pre Assy </span> memiliki beberapa
                                                fitur seperti:
                                            <ul>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Hitung Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
                                            <p><span style="font-weight: 600;">NB : </span>Perlu diketahui bahwa jika
                                                terdapat ctrlno yang tidak memiliki properties ketika masuk ke halaman
                                                process, hal ini menunjukkan bahwa ada ketidaksesuaian penulisan antara
                                                data dalam database Circuit Single atau Circuit Non-Single dengan data
                                                produksi. Sebagai hasilnya, ctrlno tidak dapat melengkapi propertinya.
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
                                                mengunduh data secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
                                                <li>2. Upload data dari produksi yang telah disesuaikan dengan template
                                                </li>
                                                <li>3. Klik buttons "Proses"</li>
                                                <li>4. Setelah menunggu beberapa saat, setiap ctrl no akan dilengkapi
                                                    propertiesnya</li>
                                                <li>5. Klik buttons "Download Excel"</li>
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
                                                <li>1. Masuk ke halaman Proses Final Assy/Pre Assy setelah melakukan
                                                    upload data produksi</li>
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
                                            <div style="text-align: center; margin-top: 8pt;">
                                                <img src="{{ asset('dist/img/buttons-hitung.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Hitung : </span> digunakan untuk
                                                menghitung process cost dari wire cost, material cost, component cost,
                                                process cost, total cost, dan total amount.</p>
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
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk mengatur
                                                ulang halaman.</p>
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
                                                    saja
                                                </li>
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
                            <h3 class="card-title">Perhitungan Process Cost Pre Assy/Final Assy</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" onclick="toggleCardCollapse(3)">
                                    <i id="collapseIcon3" class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseCard3">
                            <table class="table table-bordered" style="width: 1010px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/hitung.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/hitung.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Perhitungan Process Cost Final Assy :
                                                </span> berisi data dari
                                                departemen produksi yang telah dilengkapi propertiesnya dengan
                                                menyesuaikan data dari circuit single dan circuit non single berdasarkan
                                                ctrlno sampai melakukan hitung process cost.</p>
                                            <p><span style="font-weight: 600;">Perhitungan Process Cost Final Assy
                                                </span> terletak pada satu halaman yang sama dengan Proses Final
                                                Assy/Pre Assy, sehingga masih memiliki fitur yang sama yaitu
                                            <ul>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Hitung Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
                                            <p><span style="font-weight: 600;">NB : </span>Perlu diketahui bahwa jika
                                                terdapat perhitungan yang bernilai null atau kosong, terdapat dua
                                                kemungkinan yang mungkin terjadi sehingga pada kolom keterangan menunjukkan "#N/A", seperti:</p>
                                            <ul>
                                                <li>1. Jika Wire Cost terdapat nilai null atau kosong, maka itu menunjukkan pada kolom CL bernilai (0) atau tidak ada price yang terdaftar dalam tabel Master Price
                                                <li>2. Jika Component Cost terdapat nilai null atau kosong, maka itu menunjukkan pada kolom-kolom properties ada yang tidak memiliki price dalam tabel Master Price
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{ asset('dist/img/hitung-pa.png') }}" target="_blank">
                                                <img src="{{ asset('dist/img/hitung-pa.png') }}" alt=""
                                                    style="width: 25rem;">
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Perhitungan Process Cost Pre Assy :
                                                </span> berisi data dari
                                                departemen produksi yang telah dilengkapi propertiesnya dengan
                                                menyesuaikan data dari circuit single dan circuit non single berdasarkan
                                                ctrlno sampai melakukan hitung process cost.</p>
                                            <p><span style="font-weight: 600;">Perhitungan Process Cost Pre Assy </span>
                                                terletak pada satu halaman yang sama dengan Proses Final Assy/Pre Assy,
                                                sehingga masih memiliki fitur yang sama yaitu:
                                            <ul>
                                                <li>Download Data</li>
                                                <li>Delete Data</li>
                                                <li>Hitung Data</li>
                                                <li>Reset Data</li>
                                                <li>Cari Data</li>
                                            </ul>
                                            </p>
                                            <p><span style="font-weight: 600;">NB : </span>Perlu diketahui bahwa jika
                                                terdapat perhitungan yang bernilai null atau kosong, terdapat dua
                                                kemungkinan yang mungkin terjadi sehingga pada kolom keterangan menunjukkan "#N/A", seperti:</p>
                                            <ul>
                                                <li>1. Jika Wire Cost terdapat nilai null atau kosong, maka itu menunjukkan pada kolom CL bernilai (0) atau tidak ada price yang terdaftar dalam tabel Master Price
                                                <li>2. Jika Component Cost terdapat nilai null atau kosong, maka itu menunjukkan pada kolom-kolom properties ada yang tidak memiliki price dalam tabel Master Price
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
                                                mengunduh data secara keseluruhan dalam bentuk file
                                                Excel.</p>
                                            <p>Cara untuk Download Data yaitu : </p>
                                            <ul>
                                                <li>1. Masuk ke halaman Final Assy/Pre Assy</li>
                                                <li>2. Upload data dari produksi yang telah disesuaikan dengan template
                                                </li>
                                                <li>3. Klik buttons "Proses"</li>
                                                <li>4. Setelah menunggu beberapa saat, setiap ctrl no akan dilengkapi
                                                    propertiesnya</li>
                                                <li>5. Klik buttons "Download Excel"</li>
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
                                                <li>1. Masuk ke halaman Proses Final Assy/Pre Assy setelah melakukan
                                                    upload data produksi</li>
                                                <li>2. Centang checkbox pada data yang akan dihapus</li>
                                                <li>3. Klik buttons "Hapus" </li>
                                                <li>4. Setelah klik buttons hapus, akan muncul pesan untuk memastikan
                                                    <span style="font-weight: 600;">"apakah yakin untuk menghapus data
                                                        tersebut?"
                                                    </span>
                                                    <p> klik <span style="font-weight: 600;">"Ya"</span> jika ingin
                                                        menghapus, dan
                                                    <p> klik <span style="font-weight: 600;">"Tidak"</span> jika tidak
                                                        ingin menghapus
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="text-align: center;">
                                                <img src="{{ asset('dist/img/buttons-hitung.png') }}" alt=""
                                                    style="width: 5rem;">
                                            </div>
                                        </td>
                                        <td>
                                            <p><span style="font-weight: 600;">Hitung : </span> digunakan untuk
                                                menghitung process cost dari wire cost, material cost, component cost,
                                                process cost, total cost, dan total amount.</p>
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
                                            <p><span style="font-weight: 600;">Reset : </span> digunakan untuk mengatur
                                                ulang halaman.</p>
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
                                                data
                                                yang sedang dibutuhkan.</p>
                                            <p>Ada dua fitur cari yaitu : </p>
                                            <ul>
                                                <li>1. Cari data secara manual yaitu dengan mengetikkan data yang
                                                    dibutuhkan
                                                </li>
                                                <li>2. Cari data secara dropdown dimana dropdown ini hanya berdasarkan
                                                    ctrlno
                                                    saja
                                                </li>
                                            </ul>
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