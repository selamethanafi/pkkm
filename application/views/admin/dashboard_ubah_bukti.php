<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
  <h1>Ubbah Bukti Instrumen Evaluasi Mandiri Madrasah</h1>
	<?php
      if(isset($error))
        {
			echo '<div class="alert alert-warning">';
            echo "ERROR UPLOAD : <br/>";
            print_r($error);
            echo "<hr/>";
			echo '</div>';
        }
	$tc = $this->db->query("SELECT * FROM `bukti` WHERE `id`= '$id_bukti'");
	if($tc->num_rows() == 0)
	{
		echo '<div class="alert alert-danger">Data bukti tidak ditemukan</div>';
	}
	else
	{
		foreach($tc->result() as $c)
		{
			$kode = $c->kode;
			$no = $c->no;
			$ta = $this->db->query("SELECT * FROM `sub_unsur` WHERE `kode`= '$kode' and `no` = '$no'");
			foreach($ta->result() as $a)
			{
				$keterangan = $a->bukti;
			}
			?>
			<h4><?php echo $keterangan;?></h4>
					<form method="post" action="<?php echo base_url().'admin/perbaruibuktiupload/'.$kode.'/'.$no.'/'.$id_bukti;?>">
					<div class="form-group row">
					<div class="col">Status :</div><div class="col"><select name="status" class="form-control" required><option value="<?php echo $c->status;?>"><?php echo $c->status;?></option><option value="draft">draft</option><option value="final">final</option></select></div>
					</div>
					<div class="form-group row">
						<div class="col">Keterangan : </div>			
						<div class="col"><textarea name="keterangan_berkas" class="form-control"><?php echo $c->keterangan;?></textarea></div>
					</div>
					<div class="row">
						<div class="col"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
					<div class="col"><a href="<?php echo base_url().'admin/unsur/'.$kode.'/'.$no;?>" class="btn btn-info btn-block"/>Batal</a></div>
				</div>
				</form>
				<?php
		}
	}
?>
</div>
