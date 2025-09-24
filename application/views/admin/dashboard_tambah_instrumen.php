<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ta = $this->db->query("select * from `instrumen` where `tahun` = '$tahun' order by `urut` DESC limit 0,1 ");
$urut=1;
foreach($ta->result() as $a)
{
	$urut = $a->urut;
}
$urut++;
?>
 <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
        <form method="post" action="<?php echo base_url().'admin/simpaninstrumen';?>">
		<div class="form-group row">
            <div class="col-sm-3">Kode : </div>
        	<div class="col-sm-9"><input type="text" name="kode" value="<?php echo $tahun;?>." class="form-control"></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-3">Nomor :</div><div class="col-sm-9"><input type="number" name="urut" value="<?php echo $urut;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-3">Teks Instrumen </div>
            <div class="col-sm-9"><input type="text" name="kriteria" class="form-control" required></div>
		</div>
		<div class="row">
            <div class="col-sm-3"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
            <div class="col-sm-9"><a href="<?php echo base_url().'admin';?>" class="btn btn-info btn-block"/>Batal</a></div>
		</div>
        </form>
</div>
