<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstDosenPengampu extends Model
{
    protected $table = "mst_dosen_mengampu";
	protected $primaryKey = "id";
	public $incrementing = true;

	const STATUS_SKRIPSI_SELECT = [
        '0' => 'Pengajuan',
        '1' => 'Disetujui',
		'2' => 'Tidak Disetujui',
		// '3' => 'Dibatalkan',
    ];
}
