<table class="table table-bordered" style="width: 100%;" id="konsepTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="text-align:center" scope="col"><input type="checkbox"
                    class="sub_chk" id="master"></th>
            <th style="text-align:center" scope="col">No</th>
            <th style="text-align:center" scope="col">Ctrl No</th>
            <th style="text-align:center" scope="col">Kind New</th>
            <th style="text-align:center" scope="col">Size New</th>
            <th style="text-align:center" scope="col">Col New</th>
            <th style="text-align:center" scope="col">C/L-28</th>
            <th style="text-align:center" scope="col">Term B New</th>
            <th style="text-align:center" scope="col">Acc B1 New</th>
            <th style="text-align:center" scope="col">Acc B2</th>
            <th style="text-align:center" scope="col">Tube B New</th>
            <th style="text-align:center" scope="col">Term A New</th>
            <th style="text-align:center" scope="col">Acc A1 New</th>
            <th style="text-align:center" scope="col">Acc A2</th>
            <th style="text-align:center" scope="col">Tube A New</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($konsep_commonize as $c)
        <tr id="tr_{{ $c->id }}">
            <td style="text-align: center;"><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td style="text-align:center">{{$no++}}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->ctrl_no }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->kind_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->size_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->col_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->cl_28 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->term_b_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acc_b1_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acc_b2 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->tube_b_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->term_a_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acc_a1_new }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->acc_a2 }}</td>
            <td style="white-space: nowrap; text-align:center">{{ $c->tube_a_new }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>