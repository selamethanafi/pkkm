<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
	<?php
        if(isset($error))
        {
			echo '<div class="alert alert-warning">';
            echo "ERROR UPLOAD : <br/>";
            print_r($error);
            echo "<hr/>";
			echo '</div>';
        }

	$tc = $this->db->query("select * from `sub_unsur` WHERE `kode`='$kode' and `no`='$no'");
	if($tc->num_rows() == 0)
	{
		echo 'data intrumen tidak ditemukan';
	}
	else
	{
		foreach($tc->result() as $c)
		{
			$indikator = $c->indikator;
			$bukti_fisik = $c->bukti;
			$dicapai = $c->dicapai;
		}
		echo '<p>Instrumen Kode '.$kode.' Nomor '.$no.'</p>';
		$tb = $this->db->query("select * from `instrumen` WHERE `kode`='$kode'");
		if($tb->num_rows() == 0)
		{
			echo 'data tidak ditemukan';
		}
		else
		{
			foreach($tb->result() as $b)
			{
				$tugas = $b->kriteria;
			}
			echo '<p>'.$tugas.'</p><p>'.$indikator.'</p><p class="text-danger">Dicapai</p><h3 class="text-success">'.$dicapai.'</h3>';
		echo '<div class="alert alert-info"><p>Bukti Fisik</p>'.$bukti_fisik.'</div>';
			  
        ?>
		<h4>Nama Bukti</h4>
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/upload/'.$kode.'/'.$no;?>">
		<div class="form-group row">
            <div class="col">Berkas : </div>
        	<div class="col"><input type="file" name="berkas"></div>
		</div>
		<div class="form-group row">
            <div class="col">Status :</div><div class="col"><select name="status" class="form-control" required><option value=""></option><option value="draft">draft</option><option value="final">final</option></select></div>
		</div>
		<div class="form-group row">
            <div class="col">Keterangan bukti (bisa menyalin teks nama bukti): </div>			
            <div class="col"><input type="text" name="keterangan_berkas" class="form-control" required></div>
		</div>
		<div class="row">
            <div class="col"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
            <div class="col"><a href="<?php echo base_url().'admin/unsur/'.$kode.'/'.$no;?>" class="btn btn-info btn-block"/>Batal</a></div>
		</div>
        </form>
		<?php
		}
		
	}
	?>
	<br /><br /><br />
	</div>
