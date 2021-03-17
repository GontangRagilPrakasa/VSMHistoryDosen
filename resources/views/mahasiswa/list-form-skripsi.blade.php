@extends('layouts.admin')
@section('title', 'Form Pengajuan Skripsi')
@section('contentCss')
<style>
div.dt-buttons{
	position:relative;
	float:right;
	margin-bottom: 10px;
}
</style>
@endsection
@section('contentJs')
<script>
    var token = '';

    table = $('#grdDataGeografi').DataTable({
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        ordering: true, //Initial no order.
        searching: true,
        info: false,
        responsive: true,
        buttons: [
            // {
            //     text:      '<i class="fa fa-file-excel-o"></i> Export to Excel',
            //     titleAttr: 'Excel',
            //     extend: 'excelHtml5'
            // }
        ],
        ajax: {
            url: '{{ url("mahasiswa/list-skripsi-form") }}',
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
			{ data: "dosen_name", name: "dosen_judul"},
			{ data: "created_at", name: "created_at"},
			{ data: "approval", name: "approval"},
            { data: "dosen_judul_id", name: "dosen_judul_id", orderable: false, 
                render: function(data, type, row, meta){
                    var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.dosen_judul_id+'\');"><i class="fa fa-eye"></i></a>';
                    return '<div class="btn-group">\
							'+elShow+'\
						</div>';
                } 			
            },
        ],
        columnDefs: [
            {
                targets: [1,2], 
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

    $('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('admin/desa-dana/update') }}", 
            contentType: false,
            processData: false,   
            cache: false,
			selectorBlock: '#dlgData .modal-content',
			selectorAlert: '#alertData',
			success : function(ret){
				if (ret.result == true) {
					$('#dlgData').modal('hide');
					alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});
					table.draw();
				} else {
					alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
				}
			},
		});
	});

    function editData(periode_id){
        postData = new Object();
		postData.periode_id = periode_id;
		ajax({
			url : "{{ url('admin/desa-dana/show') }}", 
			postData : postData,
			success : function(ret){
				$('#dlgData').modal('show');
				var data = ret.data;
				console.log(data);
				$( "#desa-result" ).html(data.desa);

                $('#dana_id').val(data.dana_id);
                $('#periode_id').val(data.id);
				$('#dana_masuk').val(data.dana_masuk);
				$('#musdes').val(data.musdes);

            }
		});
    }

    $('#filter_search').click(function(e){
        table.draw();
    });

	$('#btnAdd').click(function(e){
		alertBox('hide', {selectorAlert: '#alertData'});
		$('.modal-footer').removeAttr('style');
		$('#token').val(token);
		$('#addData').modal('show');
	});




</script>
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
		<div class="">
			<div class="col-md-12">
				<button id="btnAdd" class="btn btn-default">Form Pengajuan Skripsi</button>
			</div>
		</div>
		<br><br>
		@if (Session::has('msg'))
		<div class="">
			<div class="col-md-12 ">  
				<div class="alert alert-danger alert-dismissible fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Peringatan!</strong> {!! Session::get("msg") !!} <strong>Silahkan menggunakan format yang benar!</strong>
				</div>
			</div>
		</div>
		@endif
		
		<br><br>
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
						<span class="fa fa-filter"> Filter</span>
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
					<th style="width: ;">Tanggal Pengajuan</th>
					<th style="width: ;">Status</th>
					<th style="width: 80px;">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<div id="dlgData" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Data Dana Desa <b id="desa-result"></b></h4>
			</div>

			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
			@csrf
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					<input type="hidden" name="mode" value="edit" id="mode">
					<input type="hidden" name="dana_id" id="dana_id">
                    <input type="hidden" name="periode_id" id="periode_id">

					<div class="form-group">
						<label class="col-sm-3 control-label" for="dana_masuk">Judul Penelitian </label>
						<div class="col-sm-9">
							<input type="text" class="form-control rupiah" id="dana_masuk" name="dana_masuk" required="" value="">
						</div>
					</div>
				</div>
					
					
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" id="save-data">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="addData" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Import Data Bumdes (.xlsx)</h4>
			</div>
			<form class="form-horizontal" action="{{ url('admin/bumdes/import') }}" method="post" enctype="multipart/form-data" >
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="file" name="file_idm" id="file_idm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required class="form-control">
                </div>

				<div class="modal-footer">
				    <a href="{{ asset('excel/bumdes.xlsx') }}" class="btn btn-success" id="download-sample">Download Template</a>
					<button type="submit" class="btn btn-default" >Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

</div>

@endsection
