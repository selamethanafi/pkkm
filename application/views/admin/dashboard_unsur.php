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
			echo '<tr><td>NILAI PENCAPAIAN</td><td>'.$a->dicapai.'</td></tr>';
		}
		echo '</table>';
		echo '<div class="alert alert-info"><p>Bukti Fisik</p>'.$bukti_fisik.'</div>';
		$nomor = 1;
		$ada = 0;
		$tc = $this->db->query("select * from `bukti` WHERE `kode`='$kode' and `no`= '$no'");
		echo '<div class="row"><div class="col"><a href="'.base_url().'admin/tambahbukti/'.$kode.'/'.$no.'">Unggah Bukti</a></div><div class="col"><a href="'.base_url().'admin/tambahtautan/'.$kode.'/'.$no.'">Tambah Tautan</a></div></div>';
		echo '<table class="table table-hover table-striped table-bordered"><td>Dokumen</td><td>Status</td><td colspan="2">Aksi</td></tr>';
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
			echo '</td><td>'.$c->status.'</td><td><a href="'.base_url().'admin/ubahbukti/'.$kode.'/'.$no.'/'.$c->id.'" class="btn btn-info"> Ubah</a></td><td><a href="'.base_url().'admin/konfirmhapus/'.$kode.'/'.$no.'/'.$c->id.'" class="btn btn-danger"> Delete</a></td></tr>';
		}
		echo '</table>';
		if($ada > 0)
		{
			echo '<p><a href="'.base_url().'admin/arsip/'.$kode.'" class="btn btn-success btn-primary">Buat Arsip Zip</a></p>';
		}
	}
	?>
	</div>
