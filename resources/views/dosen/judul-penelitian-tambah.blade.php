@extends('layouts.admin')
@section('title', 'Penelitian Dosen')
@section('contentCss')
<style>
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
    $('#formData').submit(function(){
		var formData = new FormData($('#formData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
			url : "{{ url('dosen/list-penelitian-save') }}", 
            contentType: false,
            processData: false,   
            cache: false,
			success : function(ret){
				if (ret.result == true) {
					alert(ret.msg);

                    setTimeout(function() {
                        window.location.href = "{{ url('dosen/penelitian') }}";
                    }, 1000);
				} else {
					alert(ret.msg);
				}
			},
		});
	});

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" class="form-control" name="judul[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="icon-repeat"></i> Hapus</a></div>'; //New input field html 
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
</script>
@endsection

@section('content')
<div class="content">
	<center><div id="alertData" style="display: none;"></div></center>
	<form class="form-horizontal" id="formData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
		<div class="col-md-10">
			<div class="form-group field_wrapper">
				<label for="geografi">Tambah Penelitian Dosen</label>
				<input type="text" class="form-control" id="field_name" name="judul[]" required="" value="">
                <a href="javascript:void(0);" class="add_button" title="Add field"><i class="icon-repeat"></i> Tambah</a>
			</div>	
			<br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</form>
</div>
@endsection