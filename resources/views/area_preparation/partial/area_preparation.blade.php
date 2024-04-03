<table class="table table-bordered" style="width: 100%;" id="fa_1aTableBody">                    
    <thead style="height:40px">
        <tr class="table-secondary" style=" position: sticky; top: 0;">
            <th scope="col"><input type="checkbox" class="sub_chk" id="master"></th>
            <th scope="col">No</th>
            <th scope="col">Kav</th>
            <th scope="col">Bagian</th>
            <th scope="col">Area Store</th>
            <th scope="col">Material</th>
            <th scope="col">Warna</th>
            <th scope="col">Qty Board</th>
            <th scope="col">Publish</th>
            <th scope="col">Total Qty</th>
            <th scope="col">Plank</th>
            <th scope="col">Month</th>
            <th scope="col">Year</th>
            <th scope="col">Factory</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        @forelse ($area_preparation as $c)
        <tr id="tr_{{ $c->id }}">
            <td><input type="checkbox" class="sub_chk" data-id="{{$c->id}}"
                    onclick="handleCheckboxChange({{ $c->id }})"></td>
            <td>{{$no++}}</td>
            <td>{{ $c->kav }}</td>
            <td>{{ $c->bagian }}</td>
            <td>{{ $c->area_store }}</td>
            <td>{{ $c->material }}</td>
            <td>{{ $c->warna }}</td>
            <td>{{ $c->qty_board }}</td>
            <td>{{ $c->publish }}</td>
            <td>{{ $c->total_qty }}</td>
            <td>{{ $c->plank }}</td>
            <td>{{ $c->month }}</td>
            <td>{{ $c->year }}</td>
            <td>{{ $c->factory }}</td>
        </tr>
        @empty
        <br>
        <div class="alert alert-danger">
            Data belum Tersedia.
        </div>
        @endforelse
    </tbody>
</table>