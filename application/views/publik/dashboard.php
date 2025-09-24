<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
	$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' order by `urut`");
	echo '<table class="table table-hover table-striped table-bordered"><td>Nomor</td><td>TUGAS UTAMA/UNSUR TUGAS UTAMA</td><td>NO
</td><td>INDIKATOR KERJA</td><td>DATA KINERJA YANG DIHARAPKAN</td><td>BUKTI OTENTIK KUALITAS KINERJA*</td></tr>';
	$nomor = 1;
	foreach($ta->result() as $a)
	{
		$id = $a->kode;
		$kode = $id;
		$tb = $this->db->query("SELECT * FROM `sub_unsur` WHERE `tahun` = '$tahun' and `kode` = '$id' order by `no`");
		$cacah = $tb->num_rows();
		if($cacah > 0)
		{
			echo '<tr><td align="center" rowspan="'.$cacah.'">'.$a->kode.'</td><td rowspan="'.$cacah.'">'.$a->kriteria.'</td>';

		}
		else
		{
			echo '<tr><td align="center">'.$a->kode.'</td><td>'.$a->kriteria.'</td>';
		}

		$baris = 1;
		foreach($tb->result() as $b)
		{
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
				echo '<td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.''.$link.'</td><td></tr>';
			}
			else
			{
				echo '<tr><td>'.$baris.'</td><td>'.$b->indikator.'</td><td>'.$b->data.'</td><td>'.$b->bukti.''.$link.'</td></tr>';
			}
			$baris++;
		}
	
	}
	echo '</table>';
	?>
