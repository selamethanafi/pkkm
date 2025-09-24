<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
	echo '<H1>Tahun Penilaian '.$tahun.'</h1>';
	echo '<p><a href="'.base_url().'admin/tambahinstrumen" class="btn btn-primary">Tambah Instrumen</a></p>';
	echo '<div class="alert alert-info"><p>Untuk mengubah pencapaian klik tombol kolom dicapai</p><p>Untuk mengunggah bukti klik tombol mata di kolom lihat</p></div>';
 	

	$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' order by `urut`");
	echo '<table class="table table-hover table-striped table-bordered"><td>Nomor</td><td>Kode</td><td>TUGAS UTAMA/UNSUR TUGAS UTAMA</td><td>NO
</td><td>INDIKATOR KERJA</td><td>DATA KINERJA YANG DIHARAPKAN</td><td>BUKTI OTENTIK KUALITAS KINERJA*</td><td>Unggah</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$kode = $id;
		$tb = $this->db->query("SELECT * FROM `sub_unsur` WHERE `tahun` = '$tahun' and `kode` = '$id' order by `no`");
		$cacah = $tb->num_rows();
		if($cacah > 0)
		{
			echo '<tr><td align="center" rowspan="'.$cacah.'">'.$nomor.'</td><td align="center" rowspan="'.$cacah.'">'.substr($a->kode,5).'</a></td><td rowspan="'.$cacah.'">'.$a->kriteria.' <a href="'.base_url().'admin/ubahinstrumen/'.$id.'" class="btn btn-warning">Ubah</a>  <a href="'.base_url().'admin/tambahindikator/'.$id.'" class="btn btn-success">Tambah Indikator</a></td>';

		}
		else
		{
			echo '<tr><td align="center">'.$nomor.'</td><td align="center">'.substr($a->kode,5).'</td><td>'.$a->kriteria.' <a href="'.base_url().'admin/ubahinstrumen/'.$id.'" class="btn btn-warning">Ubah</a>  <a href="'.base_url().'admin/tambahindikator/'.$id.'" class="btn btn-success">Tambah Indikator</a></td>';
		}

		$baris = 1;
		foreach($tb->result() as $b)
		{
			$dicapai = $b->dicapai;
			$no = $b->no;
			$link = '<ol>';
			$tc = $this->db->query("select * from `bukti` WHERE `kode`='$kode' and `no`= '$no'");
			foreach($tc->result() as $c)
			{
				if($c->tipe == 'tautan')
				{
					$link .= '<li><a href="'.$c->nama_bukti.'" target="_blank">'.$c->keterangan.'</a></li>';
				}
				elseif($c->tipe == 'file')
				{
					$link .= '<li><a href="'.base_url().'unggahan/'.$c->nama_bukti.'" target="_blank">'.$c->keterangan.'</a></li>';
				}
				else
				{
					
				}
			}
			$link .= '</ol>';
			if($baris == '1	')
			{
				echo '<td><a href="'.base_url().'admin/ubahdata/'.$a->kode.'/'.$no.'" class="btn btn-success">'.$baris.'</a></td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.''.$link.'</td><td><a href="'.base_url().'admin/unsur/'.$a->kode.'/'.$b->no.'" class="btn btn-success">Unggah</a></td></tr>';
			}
			else
			{
				echo '<tr><td><a href="'.base_url().'admin/ubahdata/'.$a->kode.'/'.$no.'" class="btn btn-success">'.$baris.'</a></td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.''.$link.'</td><td><a href="'.base_url().'admin/unsur/'.$a->kode.'/'.$b->no.'" class="btn btn-success">Unggah</a></td></tr>';
			}
			$baris++;
		}
		$nomor++;
	
	}
	echo '</table>';
	?>
