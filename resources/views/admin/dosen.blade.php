@extends('layouts.admin')
@section('title', 'Data Dosen')
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
            url: '{{ url("admin/dosen-list-all") }}',
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
			{ data: "dosen_jk", name: "dosen_jk"},
			{ data: "dosen_telp", name: "dosen_telp"},
            { data: "dosen_id", name: "dosen_id", orderable: false, 
                render: function(data, type, row, meta){
                    var elShow = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row.dosen_id+'\');"><i class="fa fa-eye"></i></a>';
					var elDelete = '<a class="btn btn-sm btn-default" href="javascript: deleteData(\''+row.dosen_id+'\', \''+row.dosen_name+'\');"><i class="fa fa-trash"></i></a>';
                    return '<div class="btn-group">\
							'+elShow+'\
							'+elDelete+'\
						</div>';
                } 			
            },
        ],
        columnDefs: [
            {
                targets: [1,2,3], 
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

	function deleteData(dosen_id, dosen_name){
		conf = confirm("Apakah anda yakin akan menghapus Dosen "+dosen_name+" ?");
		if( conf ){
			postData = new Object();
			postData.dosen_id = dosen_id;

			ajax({
				url : "{{ url('admin/dosen-delete') }}", 
				postData : postData,
				success : function(ret){
					alert("Dosen "+dosen_name+" sudah berhasil dihapus");
					table.draw();
				},
			});		
		}
	}

    function editData(dosen_id){
        postData = new Object();
		postData.dosen_id = dosen_id;
		ajax({
			url : "{{ url('admin/dosen-show') }}", 
			postData : postData,
			success : function(ret){
				$('#dlgData').modal('show');
				$('#mode').val('edit');
				var data = ret.data;
				$('#dosen_id').val(data.dosen_id);
                $('#dosen_name').val(data.dosen_name);
				$('#dosen_jk').val(data.dosen_jk).trigger('change');
                $('#dosen_telp').val(data.dosen_telp);
				$('#email-class').addClass('hidden');
				$('#email').attr("required", false);
				$('#password-class').addClass("hidden");
				$('#password').attr("required", false);

            }
		});
    }

    $('#filter_search').click(function(e){
        table.draw();
    });

	$('#btnAddDosen').click(function(e){
		alertBox('hide', {selectorAlert: '#alertData'});
		$('.modal-footer').removeAttr('style');
		$('#token').val(token);
		$('#dlgData').modal('show');
		$('#email-class').removeClass('hidden');
		$('#email').attr("required", true);
		$('#password-class').removeClass("hidden");
		$('#password').attr("required", true);

	});

	$('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('admin/dosen-save') }}",
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

</script>
@endsection

@section('content')
<div class="row">
	<div class="row col-md-12">
		<div class="">
			<div class="col-md-12">
				<button id="btnAddDosen" class="btn btn-default">Tambah Data Dosen</button>
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
                    <th style="width: ;">Jenis Kelamin</th>
                    <th style="width: ;">No Telp</th>
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
				<h4 class="modal-title">Tambah Data Dosen</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="text" name="mode" id="mode" value="add" required class="hidden">
					<input type="text" name="dosen_id" id="dosen_id" class="hidden">
					<div class="form-group">
                        <label class="col-sm-3 control-label" for="dosen_name">Nama Dosen</label>
                        <div class="col-sm-9">
							<input type="text" name="dosen_name" id="dosen_name" required class="form-control">
                        </div>
                    </div>

					<div class="form-group" id="email-class">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-9">
							<input type="text" name="email" id="email" class="form-control" >
                        </div>
                    </div>

					<div class="form-group">
                        <label class="col-sm-3 control-label" for="dosen_jk">Jenis Kelamin</label>
                        <div class="col-sm-9">
							<select name="dosen_jk" id="dosen_jk" class="select2" required>
                                <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
									@foreach ($genders as $key => $gender)
                                    	<option value="{{ $key }}"> {{ $gender }}</option>
									@endforeach     
                            </select>
                        </div>
                    </div>

					<div class="form-group">
                        <label class="col-sm-3 control-label" for="dosen_telp">No Telephone</label>
                        <div class="col-sm-9">
							<input type="text" name="dosen_telp" id="dosen_telp" required class="form-control">
                        </div>
                    </div>

					<div class="form-group" id="password-class">
                        <label class="col-sm-3 control-label" for="password">Pasword</label>
                        <div class="col-sm-9">
							<input type="password" name="password" id="password" class="form-control">
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

@endsection
