<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
	$ta = $this->db->query("select * from `sub_unsur` WHERE `tahun` = '$tahun' and `kode`='$kode' and `no` = '$no'");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert warning">Unsur tidak ditemukan</div>';
	}
	else
	{
		echo '<table class="table table-hover table-striped table-bordered">';
		foreach($ta->result() as $a)
		{
			$kriteria = '';
			$bukti_fisik = $a->bukti;
			$tb = $this->db->query("select * from `instrumen` WHERE `tahun` = '$tahun' and `kode`='$kode'");
			foreach($tb->result() as $b)
			{
				$kriteria = $b->kriteria;
			}
			echo '<tr><td>Tugas Utama </td><td>'.$kode.' '.$kriteria.'</td></tr>';
			echo '<tr><td>Indikator Kerja</td><td>'.$a->indikator.'</td></tr>';
			echo '<tr><td>DATA KINERJA YANG DIHARAPKAN</td><td>'.$a->data.'</td></tr>';
		}
		echo '</table>';
		$nilai = '';
		$tc = $this->db->query("select * from `nilai` WHERE `tahun` = '$tahun' and `kode`='$kode' and `no` = '$no'");
		foreach($tc->result() as $c)
			{
				$nilai = $c->dicapai;
			}
		echo '<div class="alert alert-info"><p>Bukti Fisik</p>'.$bukti_fisik.'</div>';
		$nomor = 1;
		$ada = 0;
		$tc = $this->db->query("select * from `bukti` WHERE `kode`='$kode' and `no`= '$no'");
		echo '<table class="table table-hover table-striped table-bordered"><td>Dokumen</td></tr>';
		foreach($tc->result() as $c)
		{
			if($c->status == 'final')
			{
				$ada++;
			}
			echo '<tr id="'.$c->id.'"><td>';
			if($c->tipe == 'tautan')
			{
				echo '<a href="'.$c->nama_bukti.'" target="_blank">'.$c->keterangan.'</a>';
			}
			elseif($c->tipe == 'file')
			{
				echo '<a href="'.base_url().'unggahan/'.$c->nama_bukti.'" target="_blank">'.$c->keterangan.'</a>';
			}
			else
			{
				echo 'tipe bukti tidak jelas';
			}
			echo '</td></tr>';
		}
		echo '</table>';
		echo form_open('supervisor/simpan/'.$kode.'/'.$no);
		echo '<table class="table table-hover table-striped table-bordered"><td>Skor</td><td>Pengamatan</td></tr>';
		for($i=1;$i<5;$i++)
		{
			if($i == 1)
			{
				$keterangan = 'ditemukan bukti yang sangat terbatas dan kurang meyakinkan';
			}
			if($i == 2)
			{
				$keterangan = 'ditemukan bukti yang kurang lengkap tapi cukup meyakinkan';
			}
			if($i == 3)
			{
				$keterangan = 'ditemukan bukti yang lengkap dan cukup meyakinkan';
			}
			if($i == 4)
			{
				$keterangan = 'ditemukan bukti yang lengkap dan sangat meyakinkan';
			}
			$checked = '';
			if($i == $nilai)
			{
				$checked = 'checked';
			}
			echo '<tr><td>';
			?>
			<input type="radio" name="nilai" value="<?php echo $i;?>" <?php echo $checked;?>>
			<?php
			echo '</td><td>'.$keterangan.'</td></tr>';
		}
		echo '</table>
		<p class="text-center"><input type="submit" value="Simpan" class="btn btn-primary"></p></form>';
	}
	?>
	</div>
