<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Jum 16 Jan 2015 08:43:21 WIB 
// Nama Berkas 		: mencetak_skp.php
// Lokasi   		: application/views/shared/
// Author   		: Selamet Hanafi
//       		 selamethanafi@yahoo.co.id
//
// (c) Copyright:
//        Selamet Hanafi
//        sianis.web.id
//        selamet.hanafi@gmail.com
//
// License:
//  Copyright (C) 2014 Selamet Hanafi
//  Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="/assets/css/all.css" rel="stylesheet"> <!--load all styles -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/icon.png" />
<title><?php echo $judulhalaman;?></title>
</head>
<body>

<?php
$tp = $this->db->query("select * from `penilai` where `nip` = '$username'");
foreach($tp->result() as $p)
{
	$nama_penilai = $p->nama;
	$panggol = $p->panggol;
	$jabatan = $p->jabatan;
	$unit_kerja = $p->unit_kerja;
	$nip = $p->nip;
}
echo '<table width="100%"><tr><td align="center"><h5>Hasil Penilaian Kinerja Tahun Kepala Madrasah</h5></td></tr>';
echo '<tr><td align="center"><h5>Tahun ke-1</td></tr>';
echo '</table>';
echo '<br /><br />';
echo 'Yang bertanda tangan di bawah ini:<br />';
echo '<table width="100%">';
echo '<tr><td colspan="3">Identitas Penilai</td></tr>';
echo '<tr><td width="40%">Nama</td><td width="1%">:</td><td>'.$nama_penilai.'</td></tr>';
echo '<tr><td>NIP</td><td>:</td><td>'.$nip.'</td></tr>';
echo '<tr><td>Pangkat / Golongan</td><td>:</td><td>'.$panggol.'</td></tr>';
echo '<tr><td>Jabatan</td><td>:</td><td>'.$jabatan.'</td></tr>';
echo '<tr><td>Unit Kerja</td><td>:</td><td>'.$unit_kerja.'</td></tr>';
echo '</table>';
	
echo '<table width="100%">';
echo '<tr><td colspan="3">Identitas Kepala Madrasah</td></tr>';
echo '<tr><td width="40%">Nama</td><td width="1%">:</td><td>H. Muhammad Imam Mursid, S.Ag., S.Pd., M.Pd.</td></tr>';
echo '<tr><td>NIP</td><td>:</td><td>196810312003121002</td></tr>';
echo '<tr><td>Pangkat / Golongan</td><td>:</td><td>Pembina, IV/a</td></tr>';
echo '<tr><td>Jabatan</td><td>:</td><td>Kepala Madrasah</td></tr>';
echo '<tr><td>Unit Kerja</td><td>:</td><td>MA Negeri 2 Semarang</td></tr>';
echo '</table>';
echo '<br /><br />Telah dilakukan Penilaian Kinerja Tahunan Kepala Madrasah pada tahun '.$tahun.'<br />Dengan hasil sebagai berikut:';

$batas = 4;
echo '<table><tr><td width="20%"></td><td>';
	echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td>Nomor</td><td>TUGAS UTAMA</td><td>Skor</td></tr>';
$total = 0;
for($i=1;$i<=$batas;$i++)
{
	$kode = $i.'.';
	$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' and `kode` like '$kode%' order by `urut`");
	$nomor = 1;
	$skor = 0;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$kode = $id;
		$tb = $this->db->query("SELECT * FROM `sub_unsur` WHERE `tahun` = '$tahun' and `kode` = '$id' order by `no`");
		$cacah = $tb->num_rows();
		$baris = 1;
		foreach($tb->result() as $b)
		{
			$no = $b->no;
			$tc = $this->db->query("select * from `nilai` where `tahun` = '$tahun' and `kode` = '$kode' and `no` = '$no' and `supervisor` = '$username'");
			foreach($tc->result() as $c)
			{
				$skor = $skor + $c->dicapai;
			}
		}
	}
				$total = $total + $skor;
	if($i == 1)
	{
		$tugas = 'Usaha Pengembangan Madrasah';
	}
	if($i == 2)
	{
		$tugas = 'Pelaksanaan Tugas Manajerial';
	}
	if($i == 3)
	{
		$tugas = 'Pengembangan Kewirausahaan';
	}
	if($i == 4)
	{
		$tugas = 'Supervisi kepada guru dan tenaga kependidikan';
	}
	echo '<tr><td>'.$i.'</td><td>'.$tugas.'</td><td>'.$skor.'</td></tr>';
}
	echo '<tr><td colspan="2">Jumlah</td><td>'.$total.'</td></tr>';
	echo '</table></td><td width="20%"></td></tr></table>';
echo '<br /><br /><br /><table width="100%"><tr><td width="10%"></td><td>Penilai,<br /><br /><br /><br /></td><td></td></tr>
<tr><td width="10%"></td><td>'.$nama.'</td><td></td></tr>';

echo '</table>';
//kalau oke;
echo '</div>';
