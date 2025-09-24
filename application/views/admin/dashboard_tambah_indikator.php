<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <div class="container-fluid">
    <h1><?php echo $judulhalaman;?></h1>
<?php
$ta = $this->db->query("select * from `instrumen` where `kode` = '$kode'");
foreach($ta->result() as $a)
{
	$kriteria = $a->kriteria;
	echo '<h4>'.substr($kode,5).'. '.$kriteria.'</h4>';
}
$tb = $this->db->query("select * from `sub_unsur` where `tahun` = '$tahun' and `kode` = '$kode' order by `no` ASC");
$urut=1;
foreach($tb->result() as $b)
{
	$urut = $b->no;
}
$urut++;

?>

        <form method="post" action="<?php echo base_url().'admin/simpanindikator';?>">
		<div class="form-group row">

            <div class="col-sm-2">Nomor</div><div class="col-sm-10"><input type="number" name="urut" value="<?php echo $urut;?>" class="form-control"></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-2">Indikator</div>
        	<div class="col-sm-10"><input type="text" name="indikator" class="form-control"></div>
		</div>
		<div class="form-group row">
            <div class="col-sm-2">Data Yang Diharapkan</div>			
            <div class="col-sm-10"><input type="text" name="data" class="form-control" required></div>
		</div>
<?php
	echo '<div class="form-group row"><div class="col-sm-2">Dicapai</div><div class="col-sm-9"><input type="number" name="dicapai"" class="form-control" min="0" max="4" required></div></div>';
?>
	<div class="form-group row"><div class="col-sm-12">Bukti</div></div>
	<div class="form-group row"><div class="col-sm-12"><textarea name="bukti" class="form-control" rows="10"></textarea></div>
		</div>
<?php
	echo '<div class="form-group row"><div class="col-sm-2">Cacah</div><div class="col-sm-10"><input type="number" name="cacah" class="form-control" required></div></div>';
?>

		<div class="row">
            <div class="col-sm-6"><input type="submit" value="Simpan" class="btn btn-success btn-block"/></div>
            <div class="col-sm-6"><a href="<?php echo base_url().'admin';?>" class="btn btn-info btn-block"/>Batal</a></div>
		</div>
        </form>
</div>
