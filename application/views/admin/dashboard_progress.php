<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1>Instrumen Evaluasi Diri Madrasah</h1>
	<?php
	$ta = $this->db->query("select * from `instrumen` order by `kode`");
	echo '<table class="table table-hover table-striped table-bordered"><td>Nomor</td><td>Kriteria</td><td>Dicapai</td><td>Deskripsi (dasar/penyebab memberi bobot, maksimum 3 penyebab)</td><td>Bukti</td><td>Persentase</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$dicapai = $a->dicapai;
		$persentase_total = 0;
		if(empty($a->dicapai))
		{
			$dicapai = '0';
		}
		$tb = $this->db->query("select * from `sub_unsur` WHERE `nomor_id`='$id' order by `bukti`");
		$cacah_bukti = $tb->num_rows();
		$pj = '<table>';
		$pr = 0;
		foreach($tb->result() as $b)
		{
			$id_bukti = $b->id;
			$tc = $this->db->query("SELECT * FROM `bukti` WHERE `nomor_sub_unsur` = '$id_bukti'");
			if($tc->num_rows() == 0)
			{
				$pj .= '<tr><td>'.$b->bukti.'</td><td></td></tr>';
			}
			else
			{
				$pr++;
				$pj .= '<tr><td>'.$b->bukti.'</td><td>100%</td></tr>';
			}
		}
		if($pr == 0)
		{
			$persentase = 0;
		}
		else
		{
			$persentase = round($pr / $cacah_bukti,2) * 100;
			
		}
		$pj .= '</table>';
		echo '<tr><td align="center">'.$a->kode.'</td><td>'.$a->kriteria.'</td><td>'.$dicapai.'</td><td>'.$a->ringkasan.'</td><td>'.$pj.'</td><td>'.$persentase.'%</td></tr>';
		
	}
	echo '</table>';
	?>
