@extends('layouts.admin')
@section('title', 'Dashboard')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
	$(document).ready(function(){
		$('#start_date').datepicker({
			format: 'yyyy-mm-dd',
		});

		$('#end_date').datepicker({
			format: 'yyyy-mm-dd',
		});
	});

	var token = '';

    table = $('#grdDataGeografi').DataTable({
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        ordering: true, //Initial no order.
        searching: true,
        info: false,
        responsive: true,
        buttons: [
        ],
        ajax: {
            url: '{{ url("search") }}',
            beforeSend	: function(xhr){ 
                xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            type: 'POST',
            dataType : 'json',
            data: function(d) {
                postFilter = new Object();				
                d.keyword = $('#keyword_search').val();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (errorThrown == 'Unauthorized') {
                    alert('Session Expired!');
                    location.reload();
                }
            }
        },
        order: [[ 1, "asc" ]],
        fnServerParams: function(data) {
            console.log("data"+data);
        data['order'].forEach(function(items, index) {
            data['order'][index]['column'] = data['columns'][items.column]['data'];
            });
        },
        columns: [
            { data: "id", name: "id", orderable: false,
                render: function(data, type, row, meta){
                    return (meta.row+1);
                }
            },
			{ data: "dosen", name: "dosen"},
			{ data: "label", name: "label"},
			{ data: "score", name: "score"},
			{ data: "judul", name: "judul"},
        ],
        columnDefs: [
            {
                targets: [1,2,3,4], 
                className: 'text-center',
            }
        ],
        lengthChange: true,
        pagingType: 'numbers',
        pageLength: 50,
        aLengthMenu: [
            [10, 25, 50, 100, 10000000],
            [10, 25, 50, 100, "All"]
        ],
        dom: 'Blrt<"row"<"col-md-6"><"col-md-6"p>><"clear">i',
        initComplete: function(settings, json) {
        },			
    });

	$('#filter_search').click(function(e){
        table.draw();
    });
</script>
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		<center><H2>Rekomendasi Dosen dan Siswa</H2></center>
		<hr>
	</div>
</div>

<div class="row">
	<div class="row col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="form-group has-feedback">
						<input type="text" name="keyword_search" class="form-control" placeholder="Keyword" id="keyword_search" autocomplete="off">
						<span class="fa fa-search form-control-feedback"></span>
					</div>
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-primary pull-right" id="filter_search" style="width: 100%">
						<span class="fa fa-filter"> Pencarian</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table id="grdDataGeografi" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 20px">No</th>
					<th style="width: ;">Nama Dosen</th>
					<th style="width: ;">Label</th>
					<th style="width: ;">Score</th>
					<th style="width: ;">Judul Dosen</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>


&nbsp;
@endsection