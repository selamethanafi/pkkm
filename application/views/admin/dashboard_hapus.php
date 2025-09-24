<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
	$tc = $this->db->query("select * from `bukti` WHERE `id`='$id'");
	if($tc->num_rows() == 0)
	{
		echo 'data tidak ditemukan';
	}
		else
	{
		echo '<table class="table table-hover table-striped table-bordered"><td>Dokumen</td><td>Status</td></tr>';
		foreach($tc->result() as $c)
		{
			echo '<tr id="'.$c->id.'"><td><a href="'.base_url().'unggahan/'.$c->nama_bukti.'">'.$c->keterangan.'</a></td><td>'.$c->status.'</td></tr>';
		}
		echo '</table>';
		echo '<div class="row"><div class="col"><a href="'.base_url().'admin/hapus/'.$kode.'/'.$no.'/'.$c->id.'" class="btn btn-danger btn-block"> Delete</a></div>
		<div class="col"><a href="'.base_url().'admin/unsur/'.$kode.'/'.$no.'" class="btn btn-success btn-block">Batal</a></div></div>';
	}
	?>
	</div>
