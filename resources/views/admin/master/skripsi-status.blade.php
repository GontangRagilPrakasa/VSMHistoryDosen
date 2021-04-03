<script>
$('#approval_skripsi').change(function(){
    var status = $('#approval_skripsi').val();
    if (status == 1) {
        $('#dlgDataStatus1').modal('show');

       
		var id = $('#id').val();
		if (id) {
			$.ajax({
				url : '{{ url( 'admin/master/skripsi/json' ) }}/'+id,
				type: 'GET',
				success: function( result )
				{		
					$(".dosen").prop("selectedIndex", 0);
					$('.dosen').find('option').remove().end().append('<option value=""> Pilih Pembimbing </option>');
					$.each( result, function(k, v) {
						console.log(k,v);
						$('.dosen').append($('<option>', {value:v.id, text:v.dosen}));
					});
				}
			});
        
		}

    } else if (status == 2) {
        $('#dlgDataStatus2').modal('show');
    } 
});
</script>
<select name="approval_skripsi" id="approval_skripsi" class="select2" required>
    <option value="" disabled selected hidden>Pilih Status </option>
        @foreach(App\Models\MstDosenPengampu::STATUS_SKRIPSI_SELECT as $key => $label)
            <option value="{{ $key }}" <?= (in_array($key ,[$status, 0])) ? 'selected disabled' :'' ?>>{{ $label }}</option>
        @endforeach
</select>



