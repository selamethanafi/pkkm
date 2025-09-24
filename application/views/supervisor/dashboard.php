<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
	echo '<div class="alert alert-info"><p>Untuk menilai, silakan mengklik tombol nilai</p></div>';
	$ta = $this->db->query("select * from `sub_unsur` where `tahun` = '$tahun'");
	$tc = $this->db->query("select * from `nilai` where `tahun` = '$tahun' and `supervisor` = '$username'");
	if($tc->num_rows() == 0)
	{
		foreach($ta->result() as $a)
		{
			$kode = $a->kode;
			$no = $a->no;
			$this->db->query("insert into `nilai` (`tahun`, `kode`, `no`, `supervisor`) values ('$tahun', '$kode', '$no', '$username')");
		}
	}
	$tc = $this->db->query("select * from `nilai` where `tahun` = '$tahun' and `supervisor` = '$username'");
	$cacah_instrumen = $tc->num_rows();
	$maks = 4 * $cacah_instrumen;
	$jn = 0;
	$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' order by `urut`");
	echo '<table class="table table-hover table-striped table-bordered"><td>Nomor</td><td>TUGAS UTAMA/UNSUR TUGAS UTAMA</td><td>NO
</td><td>INDIKATOR KERJA</td><td>DATA KINERJA YANG DIHARAPKAN</td><td>BUKTI OTENTIK KUALITAS KINERJA*</td><td>Nilai</td><td>Aksi</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$kode = $id;
		$tb = $this->db->query("SELECT * FROM `sub_unsur` WHERE `tahun` = '$tahun' and `kode` = '$id' order by `no`");
		$cacah = $tb->num_rows();
		if($cacah > 0)
		{
			echo '<tr><td align="center" rowspan="'.$cacah.'">'.$a->kode.'</a></td><td rowspan="'.$cacah.'">'.$a->kriteria.'</td>';

		}
		else
		{
			echo '<tr><td align="center">'.$a->kode.'</td><td>'.$a->kriteria.'</td>';
		}

		$baris = 1;
		foreach($tb->result() as $b)
		{
			$no = $b->no;
			$tc = $this->db->query("select * from `nilai` where `tahun` = '$tahun' and `kode` = '$kode' and `no` = '$no'");
			$dicapai = '';
			foreach($tc->result() as $c)
			{
				$dicapai = $c->dicapai;
			}
			if($baris == '1	')
			{
				echo '<td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.'</td><td>'.$dicapai.'</td><td><a href="'.base_url().'supervisor/nilai/'.$a->kode.'/'.$b->no.'" class="btn btn-success">Nilai</a></td></tr>';
			}
			else
			{
				echo '<tr><td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.'</td><td>'.$dicapai.'</td><td><a href="'.base_url().'supervisor/nilai/'.$a->kode.'/'.$b->no.'" class="btn btn-success">Nilai</a></td></tr>';
			}
			$jn = $jn + $dicapai;
			$baris++;
		}
	
	}
	echo '</table>';
	echo '<table class="table table-hover table-striped table-bordered"><tr><td>Skor yang diperoleh</td><td>'.$jn.'</td></tr>';
	echo '<tr><td>Skor maksimal</td><td>'.$maks.'</td></tr>';
	$nkke = $jn * 100 / $maks;
	$nkke = round($nkke);
	if($nkke > 90)
	{
		$predikat = 'Amat Baik';
	}
	elseif($nkke > 75)
	{
		$predikat = 'Baik';
	}
	elseif($nkke > 60)
	{
		$predikat = 'Cukup';
	}
	elseif($nkke > 50)
	{
		$predikat = 'Sedang';
	}
	else
	{
		$predikat = 'Kurang';
	}
	echo '<tr><td>NK (Nilai Kinerja Kepala Madrasah )</td><td>'.$nkke.'</td></tr>';
	echo '<tr><td>Predikat NK</td><td>'.$predikat.'</td></tr>';
	echo '</table>';
	?>
