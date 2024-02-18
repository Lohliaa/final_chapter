@extends('layouts.main')
@section('layouts.content')

<head>

    <link rel="stylesheet" href="{{ asset('assets/js/maxcdn.bootstrapcdn.com_bootstrap_3.3.7_css_bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_jquery_3.2.1_jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_twitter-bootstrap_3.3.7_js_bootstrap.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/js/cdnjs.cloudflare.com_ajax_libs_bootstrap-confirmation_1.0.5_bootstrap-confirmation.min.js') }}">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body style="background: lightgray">
    <figure class="text-center">
        <blockquote class="blockquote" style="font-size: 24px; font-family: Cambria;">
            <p>AKUN YANG SEDANG LOGIN
            <p>
        </blockquote>
    </figure>
    <div class="container mt-6">
        <div class="row" style="width: 1100px">
            <div class="col">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="form-row justify-content-start">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success" style="width: 1050px;">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            {{-- notifikasi form validasi --}}
                            @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @endif

                            <div class="form-group col-12">
                                <div class="row">
                                    <div class="col-md-7">
                                        <button type="button" class="btn btn-warning"
                                            onclick="handleEditClick()">Edit</button>
                                        <button style="margin-bottom: 0px" class="btn btn-danger delete_all"
                                            data-url="{{ url('DeleteUser') }}">Delete</button>
                                            <a href="{{ url('online-user') }}" class="btn btn-default">Reset</a>
                                            <span style="margin-left: 5px;"> Jumlah Data: {{ $count }}</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="margin: 0 auto;">
                            <table border="1" style="display: block; overflow: scroll; height: 500px; width: 1060px; text-align: center; margin: 0 auto;">
                            <thead style="height:40px">
                                    <tr class="table-secondary" style=" position: sticky; top: 0;">
                                        <th style="width: 50px; text-align:center" scope="col"><input type="checkbox"
                                                class="sub_chk" id="master"></th>
                                        <th style="width: 50px; text-align:center" scope="col">No</th>
                                        <th style="width: 200px; text-align:center" scope="col">Nama</th>
                                        <th style="width: 250px; text-align:center" scope="col">Email</th>
                                        <th style="width: 200px; text-align:center" scope="col">Last Seen</th>
                                        <th style="width: 150px; text-align:center" scope="col">Role</th>
                                        <th style="width: 150px; text-align:center" scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1 ?>
                                    @foreach($users as $user)
                                    <tr id="tr_{{ $user->id }}">
                                        <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"
                                                onclick="handleCheckboxChange({{ $user->id }})"></td>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->last_seen }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if(Cache::has('user-is-online-' . $user->id))
                                            <span class="text-success">Online</span>
                                            @else
                                            <span class="text-secondary">Offline</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="{{ asset('assets\js\code.jquery.com_jquery-3.6.0.min.js') }}"></script>

<script>
    @if ($errors->any())
        var errorMessages = @json($errors->all());
        var errorMessage = errorMessages.join('\n');
        alert(errorMessage);
    @elseif (session('success'))
        alert("{{ session('success') }}");
    @endif
</script>
<script>
    // Menggunakan variabel global untuk menyimpan daftar ID item yang ingin di-edit
    var itemsToEdit = [];

    // Event handler untuk checkbox
    function handleCheckboxChange(id) {
        var index = itemsToEdit.indexOf(id);
        if (index > -1) {
            itemsToEdit.splice(index, 1);
        } else {
            itemsToEdit.push(id);
        }
    }
    function handleEditClick() {
        if (itemsToEdit.length === 0) {
            alert("Please select at least one item to edit.");
        } else {
            // Membuat URL dengan fungsi url() Laravel
            var editUrl = "{{ url('edit_users') }}/" + itemsToEdit.join(',');
    
            // Redirect ke halaman edit dengan URL yang telah dibuat
            window.location.href = editUrl;
        }
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  

                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

            return false;
        });
    });
</script>

@endsection