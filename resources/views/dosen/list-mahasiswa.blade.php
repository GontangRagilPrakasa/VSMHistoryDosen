@extends('layouts.admin')
@section('title', 'List Mahasiswa')
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
  
        ],
        ajax: {
            url: '{{ url("dosen/list-mahasiswa") }}',
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
            { data: "mahasiswa_name", name: "mahasiswa_name"},
            { data: "start_mengampu", name: "start_mengampu"},
            { data: "selesai_mengampu", name: "selesai_mengampu"},
			{ data: "approval", name: "approval"},
            { data: "judul_id", name: "judul_id", orderable: false, 
                render: function(data, type, row, meta){
                    var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.judul_id+'\');"><i class="fa fa-eye"></i></a>';
                    var elDelete = '<a class="btn btn-sm btn-default" href="javascript: deleteData(\''+row.judul_id+'\');"><i class="fa fa-trash"></i></a>';
					return '<div class="btn-group">\
							'+elShow+'\
							'+elDelete+'\
						</div>';
                } 			
            },
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

    $('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('dosen/list-save-mahasiswa') }}", 
            contentType: false,
            processData: false,   
            cache: false,
			selectorBlock: '#dlgData .modal-content',
			selectorAlert: '#alertData',
			success : function(ret){
				if (ret.result == true) {
					$('#dlgData').modal('hide');
					alertBox('show', {msg: 'Data berhasil disesuaikan', mode: 'success'});
					table.draw();
				} else {
					alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
				}
			},
		});
	});

    function editData(judul_id){
		$('#dlgData').modal('show');
		$('.areyousure').html('Apakah anda sudah yakin, ingin membimbing mahasiswa tersebut?');
		$('#mode').val('edit');
		$('#judul_id').val(judul_id);
    }

	function deleteData(judul_id){
		$('#dlgData').modal('show');
		$('.areyousure').html('Apakah anda sudah yakin, ingin membatalkan mahasiswa tersebut?');
		$('#mode').val('delete');
		$('#judul_id').val(judul_id);
    }

	

	$('.datepicker').datepicker({
        changeMonth: false,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1950:2013', // Optional Year Range
        dateFormat: 'yy',
        onClose: function(dateText, inst) {
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 0, 1));
    }});

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
					<th style="width: ;">Mahasiswa</th>
                    <th style="width: ;">Start Skripsi</th>
                    <th style="width: ;">Selesai Skripsi</th>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi?</h4>
			</div>
			<div class="modal-body">
                <p class="areyousure"></p>
                <p class="debug-url"></p>
                <center>
					<br>
                	<div class="loader" style="display: none"></div>
                </center>
            </div>
            <div class="modal-footer">
            	<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="hidden" name="mode" value="" id="mode">
					<input type="hidden" name="judul_id" value="" id="judul_id">
					<button type="submit" class="btn btn-success submit-approval" id="save-data">Save</button>
				</form>
			</div>
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
