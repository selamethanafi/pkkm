<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
  <h1>Instrumen Evaluasi Diri Madrasah</h1>
	<?php
	$ta = $this->db->query("select * from `instrumen` WHERE `kode`='$id'");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert warning">Unsur tidak ditemukan</div>';
	}
	else
	{
		echo '<table class="table table-hover table-striped table-bordered"><td>Kode</td><td>Kriteria</td></tr>';
		$nomor = 1;
		foreach($ta->result() as $a)
		{
			echo '<tr><td align="center">'.$a->kode.'</td><td><p>'.$a->kriteria.'</p><p class="text-danger">Dicapai</p><p class="text-success">'.$a->dicapai.'</p><p class="text-info">'.$a->ringkasan.'</p></td></tr>';
		}
		echo '</table>';
		?>
		<form method="post" action="<?php echo base_url().'admin/simpanpencapaian/'.$id;?>">
		<table class="table">
            <tr><td>Tingkat 4</td><td><input type="radio" name="dicapai" value="4" <?php echo ($a->dicapai == '4' ? ' checked' : '');?>></td><td><?php echo $a->tingkat_4;?></td></tr>
			<tr><td>Tingkat 3</td><td><input type="radio" name="dicapai" value="3" <?php echo ($a->dicapai == '3' ? ' checked' : '');?>></td><td><?php echo $a->tingkat_3;?></td></tr>
			<tr><td>Tingkat 2</td><td><input type="radio" name="dicapai" value="2" <?php echo ($a->dicapai == '2' ? ' checked' : '');?>></td><td><?php echo $a->tingkat_2;?></td></tr>
			<tr><td>Tingkat 1</td><td><input type="radio" name="dicapai" value="1" <?php echo ($a->dicapai == '1' ? ' checked' : '');?>></td><td><?php echo $a->tingkat_1;?></td></tr>
			<tr><td>Deskripsi (dasar/penyebab)</td><td></td><td><textarea name="ringkasan" class="form-control"><?php echo $a->ringkasan;?></textarea></td></tr>
		</table>
		<div class="row">
            <div class="col"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
            <div class="col"><a href="<?php echo base_url().'admin';?>" class="btn btn-info btn-block">Batal</a></div>
		</div>
        </form>
		<?php
	}
	?>
	</div>