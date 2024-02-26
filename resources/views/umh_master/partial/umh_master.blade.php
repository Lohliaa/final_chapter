<table border="1" id="umhTableBody" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="width: 50px; text-align:center" scope="col">No</th>
            <th style="width: 200px; text-align:center" scope="col">Carline</th>
            <th style="width: 120px; text-align:center" scope="col">code 10</th>
            <th style="width: 120px; text-align:center" scope="col">code 20</th>
            <th style="width: 120px; text-align:center" scope="col">code 30</th>
            <th style="width: 120px; text-align:center" scope="col">process 10</th>
            <th style="width: 120px; text-align:center" scope="col">process 20</th>
            <th style="width: 120px; text-align:center" scope="col">process 30</th>
            <th style="width: 120px; text-align:center" scope="col">Charge</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($umh_master as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->car_line }}</td>
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