<table class="table table-bordered" style="width: 100%;" id="umhTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Kav</th>
            <th scope="col">Code 10</th>
            <th scope="col">Code 20</th>
            <th scope="col">Code 30</th>
            <th scope="col">Process 10</th>
            <th scope="col">Process 20</th>
            <th scope="col">Process 30</th>
            <th scope="col">Charge</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($umh_master as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->kav }}</td>
            <td>{{ number_format($c->code_umh1, 4, '.', '.') }}</td>
            <td>{{ number_format($c->code_umh2, 4, '.', '.') }}</td>
            <td>{{ number_format($c->code_umh3, 4, '.', '.') }}</td>
            @php
            $totalKodeUMH1 = $c->code_umh1;
            @endphp
            <td>{{ number_format($totalKodeUMH1, 4, '.', '') }}</td>
            @php
            $totalKodeUMH2 = $c->code_umh1 + $c->code_umh2;
            @endphp
            <td>{{ number_format($totalKodeUMH2, 4, '.', '') }}</td>
            @php
            $totalKodeUMH3 = $c->code_umh1 + $c->code_umh2 + $c->code_umh3;
            @endphp
            <td>{{ number_format($totalKodeUMH3, 4, '.', '') }}</td>
            <td>{{ $c->charge }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>