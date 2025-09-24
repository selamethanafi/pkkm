<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
  <h1><?php echo $judulhalaman;?></h1>
	<?php
	$ta = $this->db->query("SELECT DISTINCT `snp` FROM `daftar_sub_kegiatan` WHERE 1");
	if($ta->num_rows() == 0)
	{
		echo '<div class="alert alert warning">Daftar Sub Kegiatan tidak ditemukan</div>';
	}
	else
	{
		echo '<table class="table table-hover table-striped table-bordered">';
		$nomor = 1;
		foreach($ta->result() as $a)
		{
			$snp = $a->snp;
			$tb = $this->db->query("SELECT * FROM `daftar_sub_kegiatan` where `snp` = '$snp' limit 0,1");
			foreach($tb->result() as $b)
			{
				$kode_sub_kegiatan = $b->kode_sub_kegiatan;
				$kegiatan = $b->kegiatan;
				$sub_kegiatan = $b->sub_kegiatan;
				echo '<tr><td>'.substr($b->kode_sub_kegiatan,0,1).'</td><td colspan="4">'.$snp.' </td></tr>';
				$tc = $this->db->query("SELECT * FROM `daftar_sub_kegiatan` where `snp` = '$snp'");
				foreach($tc->result() as $c)
				{
					$kode_sub_kegiatan = $c->kode_sub_kegiatan;
					$kegiatan = $c->kegiatan;
					$sub_kegiatan = $c->sub_kegiatan;					
					$td = $this->db->query("SELECT * FROM `kegiatan` WHERE `kode` = '$kode_sub_kegiatan'");
					if($td->num_rows() > 0)
					{
						
						foreach($td->result() as $d)
						{
							$kode_edm = $d->kode_edm;
							$id_kegiatan = $d->id;
							$te = $this->db->query("SELECT * FROM `sub_unsur` WHERE `nomor_id` = '$kode_edm'");
							if($te->num_rows() > 0)
							{
								echo '<tr><td></td><td colspan="3">'.$kegiatan.' (<strong>'.$kode_edm.'</strong>)</td></tr>';
								echo '<tr><td></td><td colspan="3">'.$kode_sub_kegiatan.' '.$sub_kegiatan.'</td></tr>';
								$tf = $this->db->query("SELECT * FROM `kegiatan_rinci` WHERE `id_kegiatan` = '$id_kegiatan'");
								foreach($tf->result() as $f)
								{
									echo '<tr><td></td><td></td><td>'.$f->uraian.'</td><td align="right">'.number_format($f->biaya).'</td></tr>';
								}
							}
						}
					}
				}
				
			}

		}
		echo '</table>';
	}
	?>
	</div>