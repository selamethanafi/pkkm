<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ta = $this->db->query("select * from `instrumen` where `kode` = '$kode'");

foreach($ta->result() as $a)
{
	$urut = $a->urut;
?>
 <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
        <form method="post" action="<?php echo base_url().'admin/simpaninstrumen/'.$kode;?>">
		<div class="form-group row">
            <div class="col-sm-3">Kode : </div>
        	<div class="col-sm-9"><input type="text" name="kode" value="<?php echo $a->kode;?>" class="form-control" readonly></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-3">Nomor :</div><div class="col-sm-9"><input type="number" name="urut" value="<?php echo $urut;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-3">Teks Instrumen </div>			
            <div class="col-sm-9"><input type="text" name="kriteria" value="<?php echo $a->kriteria;?>" class="form-control" required></div>
		</div>
		<div class="row">
            <div class="col-sm-3"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
            <div class="col-sm-9"><a href="<?php echo base_url().'admin';?>" class="btn btn-info btn-block"/>Batal</a></div>
		</div>
        </form>
<?php
}
?>
</div>
