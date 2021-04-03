@extends('layouts.admin')
@section('title', 'Data Skripsi')
@section('contentCss')
<style>
div.dt-buttons{
	position:relative;
	float:right;
	margin-bottom: 10px;
}
* { box-sizing: border-box; }
    input, p { font: 18px Calibri; width: auto; }
    input { padding: 12px; margin: 3px 0; border: 1px solid #ddd; 
        border-radius: 4px; }
    input[type=button] { 
        border: solid 1px #0095ff;
        background-color: #0095ff;
        color: #fff;
        cursor: pointer;
    }
</style>
@endsection
@section('contentJs')

<script>

$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div class="col-sm-9"><input type="text" class="form-control" name="alasan[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="icon-repeat"></i> Hapus</a></div>'; //New input field html 
	var x = 1; //Initial field counter is 1
	
	//Once add button is clicked
	$(addButton).click(function(){
		//Check maximum number of input fields
		if(x < maxField){ 
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); //Add field html
		}
	});
	
	//Once remove button is clicked
	$(wrapper).on('click', '.remove_button', function(e){
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
});

$('#formData2').submit(function(){
	var formData = new FormData($('#formData2')[0]);
	$.ajax({
		type: 'POST',
		headers: {'X-CSRF-TOKEN': csrfToken},
		data: formData,
		url : "{{ url('admin/master/skripsi/pembatalan') }}",
		contentType: false,
		processData: false,
		cache: false,
		selectorBlock: '#dlgDataStatus2 .modal-content',
		selectorAlert: '#alertData',
		success : function(ret){
			if (ret.result == true) {
				$('#dlgDataStatus2').modal('hide');
				alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});
				table.draw();
			} else {
				alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
			}
		},
	});
});

</script>

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
            url: '{{ url("admin/master/skripsi/all") }}',
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
			{ data: "mahasiswa_name", name: "mahasiswa_name"},
            { data: "mahasiswa_judul_skripsi", name: "mahasiswa_judul_skripsi"},
			{ data: "pengampu_id", name: "pengampu_id", orderable: false, 
                render: function(data, type, row, meta){
                    return  '<div class="btn-group" id="approval">\
						'+approval(row.pengampu_id)+'\
					</div>';
                } 			
            },
            { data: "mahasiswa_id", name: "mahasiswa_id", orderable: false, 
                render: function(data, type, row, meta){
					var elLog = '<button class="btn btn-sm btn-default" onclick="logSkripsi('+row.mahasiswa_id+')"><i class="fa fa-history"></i></button>';
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

	function approval(pengampu_id) {
		$('#id').val(pengampu_id);
		$.ajax({
			type: 'GET',
			datatype: 'html',
			headers: {'X-CSRF-TOKEN': csrfToken},
			url : "{{ url('admin/master/list-skripsi-form/get-status') }}/"+pengampu_id, 
			contentType: false,
			processData: false,
			cache: false,
			success : function(ret){
				$('#approval').html(ret);
			},
		});	
	}

    function logSkripsi(mahasiswa_id){
        $.ajax({
			type: 'GET',
			datatype: 'html',
			headers: {'X-CSRF-TOKEN': csrfToken},
			url : "{{ url('admin/master/list-skripsi-form/get-log-by-mahasiswa') }}/"+mahasiswa_id, 
			contentType: false,
			processData: false,
			cache: false,
			success : function(ret){
				$('#log-skripsi').html(ret);
			},
		});
		$('#dlgDatalog').modal('show');
    }

    $('#filter_search').click(function(e){
        table.draw();
    });;

	$('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('admin/master/skripsi/save') }}",
            contentType: false,
            processData: false,
            cache: false,
			selectorBlock: '#dlgDataStatus1 .modal-content',
			selectorAlert: '#alertData',
			success : function(ret){
				if (ret.result == true) {
					$('#dlgDataStatus1').modal('hide');
					alertBox('show', {msg: 'Data berhasil disimpan', mode: 'success'});
					table.draw();
				} else {
					alertBox('show', {msg: ret.msg, selectorAlert: '#alertData'});
				}
			},
		});
	});

</script>
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
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
					<th style="width: ;">Nama Mahasiswa</th>
					<th style="width: ;">Judul Skripsi</th>
					<th style="width: ;">Status Skripsi</th>
					<th style="width: 80px;">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<div id="dlgDatalog" class="modal fade">
	<div class="modal-dialog modal-lg">
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

<div id="dlgDataStatus1" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Persetujuan</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="hidden" name="id" id="id" >
					<div class="form-group">
                        <label class="col-sm-3 control-label" for="dosen_id">Pembimbing 1</label>
                        <div class="col-sm-9">
							<select name="dosen_id" id="dosen_id" class="select2 dosen" required>
                                <option value="" disabled selected hidden>Pilih Pembimbing 1</option>
									
                            </select>
                        </div>
                    </div>

					<div class="form-group">
                        <label class="col-sm-3 control-label" for="dosen_id_2">Pembimbing 2</label>
                        <div class="col-sm-9">
							<select name="dosen_id_2" id="dosen_id_2" class="select2 dosen" required>
                                <option value="" disabled selected hidden>Pilih Pembimbing 2</option>
								 
                            </select>
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

<div id="dlgDataStatus2" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Alasan Tidak Setuju</h4>
			</div>
			<form class="form-horizontal" id="formData2" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<input type="hidden" name="id" id="id" >
				<div class="modal-body">    
                    <div class="form-group field_wrapper">
						<div class="col-sm-9">
                        	<input type="text" class="form-control" id="field_name" name="alasan[]" required="" value="">
                        	<a href="javascript:void(0);" class="add_button" title="Add field"><i class="icon-repeat"></i> Tambah</a>
						</div>
                    </div>	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
