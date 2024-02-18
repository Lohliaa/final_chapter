@extends('layouts.main')
@section('layouts.content')

<body style="background: lightgray">

    <div class="container mt-6">
        <div class="row">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-5">
                                <a href="{{ route('c1-duck-housing.create') }}"
                                    class="btn btn-md btn-md btn-outline-dark mb-6">TAMBAH</a>

                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#import_excel_c1duck">
                                    IMPORT EXCEL
                                </button>

                                <!-- Import Excel -->
                                <div class="modal fade" id="import_excel_c1duck" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="{{ url('import_excel_c1duck') }}"
                                            enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                                                </div>
                                                <div class="modal-body">

                                                    {{ csrf_field() }}

                                                    <label>Pilih file excel</label>
                                                    <div class="form-group">
                                                        <input type="file" name="file" required="required">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-dark">Import</button>
                                                    <br>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Export Excel -->
                                <a href="{{ url('export_excel_c1duck') }}" class="btn btn-outline-dark"
                                    target="_blank">EXPORT
                                    EXCEL</a>
                                <a href="{{ url('c1-duck-housing') }}" class="btn btn-outline-dark">Reset</a>
                            </div>

                            <div class="form-group col-3">
                                <!-- Topbar Search -->
                                <form class="form" method="get" action="{{ route('c1duck.cari') }}">
                                    {{-- <label for="inputCity">City</label> --}}
                                    <input type="text" name="cari" class="form-control w-75 d-inline" id="cari"
                                        placeholder=" ">
                                    <button type="submit" class="btn btn-outline-dark">Cari</button>
                                </form>
                            </div>

                            <div class="form-group col-4">
                                <form action="{{ route('c1duck.cari') }}" method="get">
                                    @csrf
                                    <select name="cari" class="form-control w-50 d-inline" placeholder="">
                                        <option value="" disabled selected hidden> </option>
                                        @foreach($c1duck->unique('ctrl_no') as $cd)
                                        <option value="{{ $cd->ctrl_no }}">{{ $cd->ctrl_no }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-dark">Cari</button>
                                    <span>Jumlah:({{ $count }})</span>
                                </form>
                            </div>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            {{-- notifikasi form validasi --}}
                            @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @endif
                            {{-- notifikasi sukses --}}
                            @if ($sukses = Session::get('sukses'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $sukses }}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table border="1"
                                    style="display: block; overflow:scroll; height: 500px; width:2000px; text-align:center">
                                    <thead style="height:40px">
                                        <tr class="table-secondary" style=" position: sticky; top: 0;">
                                            <th style="width: 50px" scope="col">No</th>
                                            <th style="width: 180px" scope="col">ADDRESSING STORE</th>
                                            <th style="width: 110px" scope="col">CTRL NO1</th>
                                            <th style="width: 100px" scope="col">CTRL NO2</th>
                                            <th style="width: 50px" scope="col">kind</th>
                                            <th style="width: 50px" scope="col">size</th>
                                            <th style="width: 50px" scope="col">color</th>
                                            <th style="width: 100px" scope="col">kind_size_color</th>
                                            <th style="width: 100px" scope="col">cust_part_no</th>
                                            <th style="width: 50px" scope="col">cl</th>
                                            <th style="width: 100px" scope="col">term_b</th>
                                            <th style="width: 110px" scope="col">accb1</th>
                                            <th style="width: 150px" scope="col">accb2</th>
                                            <th style="width: 110px" scope="col">tubeb</th>
                                            <th style="width: 110px" scope="col">term_a</th>
                                            <th style="width: 110px" scope="col">acca1</th>
                                            <th style="width: 150px" scope="col">acca2</th>
                                            <th style="width: 110px" scope="col">tubea</th>
                                            <th style="width: 110px" scope="col">total_qty</th>
                                            <th style="width: 150px" scope="col">car_line</th>
                                            <th style="width: 150px" scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @forelse ($c1duck as $cd)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ $cd->addressing_store }}</td>
                                            <td style="height: 0px; widht:0px">{{ $cd->ctrl_no }}</td>
                                            <td>{{ $cd->ctrlno }}</td>
                                            <td>{{ $cd->kind }}</td>
                                            <td>{{ $cd->size }}</td>
                                            <td>{{ $cd->color }}</td>
                                            <td>{{ $cd->kind_size_color }}</td>
                                            <td>{{ $cd->cust_part_no }}</td>
                                            <td>{{ $cd->cl }}</td>
                                            <td>{{ $cd->term_b }}</td>
                                            <td>{{ $cd->accb1 }}</td>
                                            <td>{{ $cd->accb2 }}</td>
                                            <td>{{ $cd->tubeb }}</td>
                                            <td>{{ $cd->term_a }}</td>
                                            <td>{{ $cd->acca1 }}</td>
                                            <td>{{ $cd->acca2 }}</td>
                                            <td>{{ $cd->tubea }}</td>
                                            <td>{{ $cd->total_qty }}</td>
                                            <td>{{ $cd->car_line }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('c1-duck-housing.destroy', $cd->id) }}" method="POST">
                                                    <a href="{{ route('c1-duck-housing.edit', $cd->id) }}"
                                                        class="btn btn-sm btn-warning">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <br>
                                        <div class="alert alert-danger">
                                            Data belum Tersedia.
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $c1duck->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

@endsection