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
<?php
echo '<table width="100%"><tr><td width="20%"></td><td colspan="3" align="center"><h4>INSTRUMEN PENILAIAN</h4></td><td width="20%"></td></tr>';
echo '<tr><td></td><td colspan="3" align="center"><h4>KEPALA MADRASAH</h4></td><td></tr>';
echo '<tr><td></td><td colspan="3" align="center"><h5<Berdasarkan Standar Kompetensi Kepala Madrasah</h5></td><td></td></tr>';
echo '<tr><td></td><td colspan="3" align="center"><h5>PMA 58 Tahun 2017</h5></td><td></td></tr>';
echo '<tr><td><br ></td><td colspan="3" align="center"></td><td></td></tr>';
echo '<tr><td></td><td>Nama Kepala Madrasah</td><td width="3%">:</td><td>H. Muhammad Imam Mursid, S.Ag., S.Pd., M.Pd.</td></tr>';
echo '<tr><td></td><td>Nama Madrasah</td><td width="3%">:</td><td>MA Negeri 2 Semarang</td></tr>';
echo '<tr><td></td><td>Alamat</td><td width="3%">:</td><td>Jalan Kelurahan Desa Tengaran Kec. Tengaran Kab. Semarang Kodepos 50775</td></tr>';
echo '<tr><td></td><td>Nama Penilai</td><td width="3%">:</td><td>'.$namasupervisor.'</td></tr>';
echo '</table>';
echo '<br /><br />';
$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' order by `urut`");
	echo '<table class="table table-hover table-striped table-bordered"><tr align="center"><td rowspan="2">Nomor</td><td rowspan="2">TUGAS UTAMA / UNSUR TUGAS UTAMA</td><td  rowspan="2" colspan="2">INDIKATOR KINERJA</td><td rowspan="2">DATA YANG DIHARAPKAN</td><td rowspan="2">BUKTI HASIL KINERJA</td><td colspan="4">HASIL KINERJA</td></tr><tr  align="center"><td>1</td><td>2</td><td>3</td><td>4</td></tr>';
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
			if($baris == '1')
			{
				echo '<td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.'</td>';
			}
			else
			{
				echo '<tr><td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.'</td>';
			}
			if($dicapai == 1)
			{
				echo '<td><i class="fa fa-check" aria-hidden="true"></i></td><td></td><td></td><td></td></tr>';
			}
			if($dicapai == 2)
			{
				echo '<td></td><td></td><td><i class="fa fa-check" aria-hidden="true"></i></td><td></td><td></td></tr>';
			}
			if($dicapai == 3)
			{
				echo '<td></td><td></td><td><i class="fa fa-check" aria-hidden="true"></i></td><td></td></tr>';
			}
			if($dicapai == 4)
			{
				echo '<td></td><td></td><td></td><td><i class="fa fa-check" aria-hidden="true"></i></td></tr>';
			}
			
			$baris++;
		}
	
	}
	echo '</table>';
//kalau oke;
echo '</div>';
