@extends('layouts.admin')
@section('title', 'Users')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
var mode = '';
var token = '';

$(document).ready(function(){
	table = $('#grdData').DataTable({
		processing: true, //Feature control the processing indicator.
		serverSide: true, //Feature control DataTables' server-side processing mode.
		ordering: true, //Initial no order.
		searching: true,
		info: false,
		responsive: true,
		ajax: {
			url: '{{ url("users/get-list") }}',
			beforeSend	: function(xhr){ 
				xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
			},
			type: 'POST',
			dataType : 'json',
			data: function(d) {
				postFilter = new Object();				
				//$.each($('#frmFilter :input').serializeObject(), function(x, y){ postFilter[x]=y; });
				//delete postFilter.cboPage;
				//d.filter = JSON.stringify(postFilter);
				d.search = $('#txtSearch').val();
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
		  data['order'].forEach(function(items, index) {
			  data['order'][index]['column'] = data['columns'][items.column]['data'];
			});
		},
		columns: [
			{ data: "user_id", name:"user_id", orderable: false, searchable: false,
				render: function(data, type, row, meta){
					return meta.row + 1;
				}
			},
			{ data: "user_full_name", name: "user_full_name" },
			{ data: "company_name", name: "company_name"},
			{ data: "role_name", name: "role_name" },
			{ data: "email", name: "email" },
			{ data: "user_phone", name: "user_phone" },
			{ data: "last_login", name: "last_login",
				render: function(data, type, row, meta){
					return showDate(data);
				} 
			}, 
			{ data: "user_id", name: "action", orderable: false, 
				render: function(data, type, row, meta){
					var elReset = '';
					if (row.role_id == 2) {
						var elReset = '<a class="btn btn-sm btn-default" href="javascript: resetData(\''+row._token+'\', \''+row.user_name+'\');"><i class="fa fa-refresh"></i></a>';
					}
					var elEdit = '<a class="btn btn-sm btn-default" href="javascript: editData(\''+row._token+'\', \''+row.user_name+'\');"><i class="fa fa-edit"></i></a>';
					var elDelete = '<a class="btn btn-sm btn-default" href="javascript: deleteData(\''+row._token+'\', \''+row.user_name+'\');"><i class="fa fa-trash"></i></a>';
					return '<div class="btn-group">\
							'+elReset+'\
							'+elEdit+'\
							'+elDelete+'\
						</div>';
				} 			
			},
		],
		columnDefs: [
			{
				targets: [1,2,3,4,5,6,7], 
				className: 'text-center',
			},
		],
		lengthChange: true,
		pagingType: 'numbers',
		pageLength: 50,
		aLengthMenu: [
	        [10, 25, 50, 100, 10000000],
	        [10, 25, 50, 100, "All"]
	    ],
		dom: 'lrt<"row"<"col-md-6"><"col-md-6"p>><"clear">i',
		initComplete: function(settings, json) {
		},			
	});
	
	$('#txtSearch').keypress(function(e){
		if(e.which == 13) {
			table.draw();
		}
	});
		
	$('#btnAdd').click(function(e){
		alertBox('hide', {selectorAlert: '#alertData'});
		$('#mode').val("add");
		$('#token').val(token);
		$('input.form-control', '#frmData').val('');
		$('textarea.form-control', '#frmData').val('');
		$('#cboRole').val($("#cboRole option:first").val()).trigger('change');
		$('#roleSubSeller').val('').trigger('change');
		$('#roleSubSupplier').val('').trigger('change');
		$('#roleSubJBA').val('').trigger('change');
		$('#cboStatus').val($("#cboStatus option:first").val()).trigger('change');
		$('#dlgData').modal('show');
		$('#txtUserName').focus();
		$('#chkPassword').iCheck('check');
		$('#chkPassword').iCheck('disable');
		mode = 'add';
	});
	
	$('#frmData').submit(function(){
		var formData = new FormData($('#frmData')[0]);

		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': csrfToken},
            data: formData,
			url : "{{ url('users/save-data') }}", 
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
	
	$('#chkPassword').on('ifToggled', function(event){
		if( $(this).is(":checked") ){
			$('#txtPassword').prop('disabled', false);
			$('#txtUserName').prop('readonly', false);
			$('#txtEmail').prop('readonly', false);
		}else{
			$('#txtPassword').prop('disabled', true);
			$('#txtUserName').prop('readonly', true);
			$('#txtEmail').prop('readonly', true);			
		}
	});
	$('#chkPassword').trigger('ifToggled');

	$('.roleSubSeller').hide();
	$('.roleSubSupplier').hide();
	$('.roleSubJBA').hide();

	$('#cboRole').change(function(){
	  	var role_id = $(this).val();
	  	 if(role_id == 2){
	  		$('.roleSubJBA').show();
	  		$('.roleSubSeller').hide();
			$('.roleSubSupplier').hide();
	  	} else if (role_id == 3) {
	  		$('.roleSubSeller').show();
	  		$('.roleSubSupplier').hide();
	  		$('.roleSubJBA').hide();
		} else if (role_id == 4) {
			$('.roleSubSupplier').show();
			$('.roleSubSeller').hide();
			$('.roleSubJBA').hide();
	  	} else {
	  		$('.roleSubSeller').hide();
			$('.roleSubSupplier').hide();
			$('.roleSubJBA').hide();
	  	}
	});
});
	
function editData(_token, username){
	mode = 'edit';
	token = _token;
	$('input.form-control', '#frmData').val('');

	postData = new Object();
	postData.token = token;
	ajax({
		url : "{{ url('users/get-data') }}", 
		postData : postData,
		success : function(ret){
			alertBox('hide', {selectorAlert: '#alertData'});
			$('#dlgData').modal('show');
			var data = ret.data;
			
			$('#mode').val("edit");
			$('#token').val(token);
			$('#txtFullName').val(data.user_full_name);
			$('#txtPhone').val(data.user_phone);
			$('#txtEmail').val(data.email);
			$('#cboRole').val(data.role_id).trigger('change');
			$('#roleSubSeller').val(data.seller_id).trigger('change');
			$('#roleSubSupplier').val(data.vendor_id).trigger('change');
			$('#roleSubJBA').val(data.cabang_id).trigger('change');
			$('#txtUserName').val(data.user_name);
			$('#txtUserAddress').val(data.address);
			$('#txtKtp').val(data.ktp_no);
			$('#txtProfil').attr('required', false);
			$('#cboStatus').val(data.active).trigger('change');
			$('#chkPassword').iCheck('uncheck');
			$('#chkPassword').iCheck('enable');			
		},
	});
}

function deleteData(_token, username){
	conf = confirm("Apakah anda yakin akan menghapus User "+username+" ?");
	if( conf ){
		postData = new Object();
		postData.token = _token;

		ajax({
			url : "{{ url('users/delete-data') }}", 
			postData : postData,
			success : function(ret){
				alert("User "+username+" sudah berhasil dihapus");
				table.draw();
			},
		});		
	}
}

function resetData(_token, username){
	conf = confirm("Apakah anda yakin akan mereset token User "+username+" ?");
	if( conf ){
		postData = new Object();
		postData.token = _token;

		ajax({
			url : "{{ url('users/reset-data') }}", 
			postData : postData,
			success : function(ret){
				alert("User "+username+" sudah berhasil direset");
				table.draw();
			},
		});		
	}
}

</script>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-9">
				<button id="btnAdd" class="btn btn-default">Add New Users</button>
			</div>
			<div class="col-md-3">
				<div class="has-feedback">
					<input id="txtSearch" type="text" class="form-control" placeholder="Search">
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>			
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table id="grdData" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 30px">No</th>
					<th>Full Name</th>
					<th>Nama Perusahaan</th>
					<th style="width: 120px;">Roles</th>
					<th>Email</th>
					<th>No. Telepon</th>
					<th style="width: 120px;">Last Login</th>
					<th style="width: 120px;">Action</th>
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
				<h4 class="modal-title">Form Users</h4>
			</div>
			<form class="form-horizontal" id="frmData" onSubmit="return false" method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="modal-body">
					<div id="alertData" style="display: none;"></div>
					@csrf
					<input type="hidden" name="mode" value="add" id="mode">
					<input type="hidden" name="token" id="token">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtFullName">Full Name *</label>
						<div class="col-sm-10">
							<input name="txtFullName" id="txtFullName" type="text" class="form-control" maxlength="255" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtPhone">Phone *</label>
						<div class="col-sm-10">
							<input name="txtPhone" id="txtPhone" type="text" class="form-control input-number" maxlength="20" required autocomplete="off">
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtEmail">Email *</label>
						<div class="col-sm-10">
							<input name="txtEmail" id="txtEmail" type="email" class="form-control" maxlength="255" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtProfil">Upload KTP *</label>
						<div class="col-sm-10">
							<input name="txtProfil" id="txtProfil" type="file" class="form-control" required accept='image/*'>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="cboRole">Role</label>
						<div class="col-sm-10">
							<select name="cboRole" id="cboRole" class="select2" required>
								<?php
									foreach($roles as $idx=>$val){
										echo '<option value="'.$val['role_id'].'">'.$val['role_name'].'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group roleSubSeller">
						<label class="col-sm-2 control-label" for="cboSeller">Seller</label>
						<div class="col-sm-10">
							<select name="roleSubSeller" class="select2" id="roleSubSeller">
								<?php
									foreach($seller as $idx=>$val){
										echo '<option value="'.$val['seller_id'].'">'.$val['seller_name'].'</option>';
									}
								?>	
							</select>	
						</div>
					</div>
					<div class="form-group roleSubSupplier">
						<label class="col-sm-2 control-label" for="cboSupplier">Supplier</label>
						<div class="col-sm-10">
							<select name="roleSubSupplier" class="select2" id="roleSubSupplier">
								<?php
									foreach($vendor as $idx=>$val){
										echo '<option value="'.$val['supplier_id'].'">'.$val['supplier_name'].'</option>';
									}
								?>
							</select>	
						</div>
					</div>
					<div class="form-group roleSubJBA">
						<label class="col-sm-2 control-label" for="roleJBA">JBA Location</label>
						<div class="col-sm-10">
							<select name="roleSubJBA" class="select2" id="roleSubJBA">
								<?php
									foreach($location as $idx=>$val){
										echo '<option value="'.$val['location_id'].'">'.$val['location_name'].'</option>';
									}
								?>
							</select>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtUserName">User Name *</label>
						<div class="col-sm-10">
							<input name="txtUserName" id="txtUserName" type="text" class="form-control" maxlength="150" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtUserAddress">Address *</label>
						<div class="col-sm-10">
							<textarea name="txtUserAddress" id="txtUserAddress" type="text" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="txtPassword">Password</label>
						<div class="col-sm-10">
							<input name="txtPassword" id="txtPassword" type="password" class="form-control" maxlength="100" required autocomplete="off">
							<label style="margin-top: 5px;"><input id="chkPassword" type="checkbox" class="icheck"> Change Password</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="cboStatus">Status</label>
						<div class="col-sm-10">
							<select name="cboStatus" id="cboStatus" class="select2" required>
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection