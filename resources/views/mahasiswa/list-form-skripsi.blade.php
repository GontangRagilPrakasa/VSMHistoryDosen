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
			{ data: "dosen_name", name: "dosen_name"},
			{ data: "dosen_name_2", name: "dosen_name_2"},
			{ data: "created_at", name: "created_at"},
			{ data: "approval", name: "approval"},
			{ data: "skripsi_log_id ", name: "skripsi_log_id ", orderable: false, 
                render: function(data, type, row, meta){
					var elLog = '<button class="btn btn-sm btn-default" onclick="unserialize('+row.skripsi_log_id+')"><i class="fa fa-history"></i></button>';
                    return '<div class="btn-group">\
							'+elLog+'\
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

	function unserialize(skripsi_log_id)
	{
		$.ajax({
			type: 'GET',
			datatype: 'html',
			headers: {'X-CSRF-TOKEN': csrfToken},
			url : "{{ url('mahasiswa/list-skripsi-form/get-log') }}/"+skripsi_log_id, 
			contentType: false,
			processData: false,
			cache: false,
			success : function(ret){
				$('#log-skripsi').html(ret);
			},
		});
		$('#dlgDatalog').modal('show');
	}

    $('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('mahasiswa/pengajuan-skripsi') }}", 
            contentType: false,
            processData: false,   
            cache: false,
			selectorBlock: '#addData .modal-content',
			selectorAlert: '#alertData',
			success : function(ret){
				if (ret.result == true) {
					$('#addData').modal('hide');
					alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});

					setTimeout(function() {
                        window.location.href = "{{ url('mahasiswa/skripsi-form/') }}";
                    }, 1000);
					table.draw();
				} else {
					alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
				}
			},
		});
	});

    function editData(dosen_judul_id,approval_status){	
		$('#dlgData').modal('show');
		$('#data').val(dosen_judul_id);
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

	var status = "<?= $skripsi ?>";
	if (status == 2 ){
		Swal.fire('Skripsi anda ditolak, silahkan perbarui judul skripsi anda')
	}

</script>
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
		@if ($skripsi == 2)
			<div class="">
				<div class="col-md-12">
					<button id="btnAdd" class="btn btn-default">Form Pengajuan Skripsi</button>
				</div>
			</div>
		@endif
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
					<th style="width: ;">Pembimbing 1</th>
					<th style="width: ;">Pembimbing 2</th>
					<th style="width: ;">Tanggal Pengajuan</th>
					<th style="width: ;">Status</th>
					<th style="width: 200;">Keterangan</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<div id="dlgDatalog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Log Skripsi</h4>
			</div>
			<div class="modal-body" id="log-skripsi">
	
			</div>
		</div>
	</div>
</div>

<div id="addData" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Pengajuan Skripsi</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<div class="form-group">
                        <label class="col-sm-3 control-label" for="rekomendasi_dosen">Masukkan Judul</label>
						
                        <div class="col-sm-9">
							<input type="text" name="mahasiswa_judul_skripsi" id="mahasiswa_judul_skripsi" class="form-control">
                        </div>
                    </div>
                </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" >Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

</div>

@endsection
