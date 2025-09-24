<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Lokasi      		: application/views/guru/
// Nama Berkas 		: edit_data_tindak_lanjut.php
// Terakhir diperbarui	: Kam 31 Des 2015 12:36:05 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               Sianis
//               www.sianis.web.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 Sianis
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<div class="container-fluid">
<h3><?php echo $judulhalaman;?></h3>
<?php
$ta = $this->db->query("select * from `sub_unsur` where `tahun` = '$tahun' and `kode` = '$kode' and `no` = '$no'");
if($ta->num_rows() > 0)
{
	foreach($ta->result() as $da)
	{
		$indikator = $da->indikator;
		$data = $da->data;
		$bukti = $da->bukti;
		$dicapai = $da->dicapai;
		$cacah = $da->cacah;
		$id = $da->id;
	}
	echo form_open('admin/simpanunsur/'.$kode.'/'.$no.'/'.$id,'class="form-horizontal" role="form"');
	echo '<div class="form-group row"><div class="col-sm-2">Indikator</div>
				<div class="col-sm-10"><input type="text" name="indikator" value="'.$indikator.'" class="form-control" ></div></div>';
	echo '<div class="form-group row"><div class="col-sm-2">Data</div><div class="col-sm-9"><input type="text" name="data" value="'.$data.'" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-2">Dicapai</div><div class="col-sm-9"><input type="text" name="dicapai" value="'.$dicapai.'" class="form-control"></div></div>';
	echo '<div class="form-group row"><div class="col-sm-2">Cacah</div><div class="col-sm-9"><input type="text" name="cacah" value="'.$cacah.'" class="form-control"></div></div>';

	echo '<div class="form-group row"><div class="col-sm-12">Bukti</div></div>
	<div class="form-group row"><div class="col-sm-12"><textarea name="bukti" class="form-control" rows="10">'.$bukti.'</textarea></div></div>';

			echo '<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p>';
		echo '</form>';
}
else
{
	echo '<div class="alert alert-danger">Data unsur tidak ditemukan</div>';
}
?>
    </div>
  </div>
</div>
