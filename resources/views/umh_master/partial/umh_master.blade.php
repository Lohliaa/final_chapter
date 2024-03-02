<table class="table table-bordered" style="width: 200%;" id="umhTableBody">
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th style="width: 50px; text-align:center" scope="col"><input
                    type="checkbox" class="sub_chk" id="master"></th>
            <th style="text-align:center" scope="col">No</th>
            <th style="text-align:center" scope="col">Carline</th>
            <th style="text-align:center" scope="col">code 10</th>
            <th style="text-align:center" scope="col">code 20</th>
            <th style="text-align:center" scope="col">code 30</th>
            <th style="text-align:center" scope="col">process 10</th>
            <th style="text-align:center" scope="col">process 20</th>
            <th style="text-align:center" scope="col">process 30</th>
            <th style="text-align:center" scope="col">Charge</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($umh_master as $c)
        <tr id="tr_{{ $c->id }}">
            <td style="text-align:center"><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td style="text-align:center">{{$no++}}</td>
            <td style="text-align:center">{{ $c->car_line }}</td>
            <td style="text-align:center">{{ number_format($c->code_umh1, 4, '.', '.') }}</td>
            <td style="text-align:center">{{ number_format($c->code_umh2, 4, '.', '.') }}</td>
            <td style="text-align:center">{{ number_format($c->code_umh3, 4, '.', '.') }}</td>
            @php
            $totalKodeUMH1 = $c->code_umh1;
            @endphp
            <td style="text-align:center">{{ number_format($totalKodeUMH1, 4, '.', '') }}</td>
            @php
            $totalKodeUMH2 = $c->code_umh1 + $c->code_umh2;
            @endphp
            <td style="text-align:center">{{ number_format($totalKodeUMH2, 4, '.', '') }}</td>
            @php
            $totalKodeUMH3 = $c->code_umh1 + $c->code_umh2 + $c->code_umh3;
            @endphp
            <td style="text-align:center">{{ number_format($totalKodeUMH3, 4, '.', '') }}</td>
            <td style="text-align:center">{{ $c->charge }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>