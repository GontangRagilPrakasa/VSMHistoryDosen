<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th width="25%">Name</th>
				<th width="60%">Result</th>
			</tr>
		</thead>
		<tbody>
			@foreach($logs as $key => $log)
				<?php $data = $log->skripsi_log; ?>
				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<?php
							$list = unserialize($data);
							if(!empty($list)){ // check if the array/string is empty
							    foreach ($list as $k => $v) {
							        echo "<b>".ucwords(str_replace('_', ' ', $k))."</b><br>";
							    }
							}	
							echo "<b>Tanggal Pengajuan</b><br>";
                            if ($log->status_skripsi == 0) echo "<b>Pengajuan</b><br>";
							if ($log->status_skripsi == 1) echo "<b>Disetujui</b><br>";
							if ($log->status_skripsi == 2) echo "<b>Tidak Disetujui</b><br>";
                            if ($log->status_skripsi == 3) echo "<b>Dibatalkan</b><br>";
						?>
					</td>
					<td>
						<?php
							$list = unserialize($data);
							if(!empty($list)){ // check if the array/string is empty
							    foreach ($list as $k => $v) {
							        echo ": ".ucwords($v)."<br>";
							    }
							}
							$date = date('d F Y H:i:s', strtotime($log->created_at));
							echo ":  $date<br>";
						?>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>