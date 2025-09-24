<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1>Instrumen Evaluasi Diri Madrasah</h1>
	<?php
	$ta = $this->db->query("select * from `instrumen` order by `kode`");
	echo '<table class="table table-hover table-striped table-bordered"><td>Nomor</td><td>Kriteria</td><td>Dicapai</td><td>Deskripsi (dasar/penyebab memberi bobot, maksimum 3 penyebab)</td><td>Bukti</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$dicapai = $a->dicapai;
		if(empty($a->dicapai))
		{
			$dicapai = '0';
		}
		$tb = $this->db->query("select * from `sub_unsur` WHERE `nomor_id`='$id' order by `bukti`");
		$pj = '<table>';
		foreach($tb->result() as $b)
		{
			$id_bukti = $b->id;
			$tc = $this->db->query("SELECT * FROM `bukti` WHERE `nomor_sub_unsur` = '$id_bukti'");
			if($tc->num_rows() == 0)
			{
				$pj .= '<tr><td>'.$b->bukti.'</td><td></td></tr>';
			}
			{
				$pj .= '<tr><td>'.$b->bukti.'</td><td>100%</td></tr>';
			}
		}
		echo '</table>';
		echo '<tr><td align="center">'.$a->kode.'</td><td>'.$a->kriteria.'</td><td>'.$dicapai.'</td><td>'.$a->ringkasan.'</td><td>'.$pj.'</td></tr>';
		
	}
	echo '</table>';
	?>
