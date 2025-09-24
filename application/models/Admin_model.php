<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Min 09 Nov 2014 17:09:41 WIB 
// Nama Berkas 		: admin_model.php
// Lokasi      		: application/views/models
// Author      		: Selamet Hanafi
//             		  selamethanafi@yahoo.co.id
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               admin@mantengaran.sch.id
//
// License:
//    Copyright (C) 2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
class Admin_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Tampil_Semua_Pengeluaran($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from `pengeluaran` where `thnajaran` = '$thnajaran' order by `tanggal` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Pengeluaran($thnajaran)
		{
			$t=$this->db->query("select * from `pengeluaran` where `thnajaran` = '$thnajaran' order by `tanggal` DESC");
			return $t;
		}
		function Tampil_Semua_Penerimaan_Siswa($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from `pemasukan` where `thnajaran` = '$thnajaran' order by `tanggal` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Penerimaan_Siswa($thnajaran)
		{
			$t=$this->db->query("select * from `pemasukan` where `thnajaran` = '$thnajaran' order by `tanggal` DESC");
			return $t;
		}
		function Tampil_Semua_Donasi($thnajaran,$limit,$ofset)
		{
			$ofset = $ofset * 1;
			$t=$this->db->query("select * from `donasi` where `thnajaran` = '$thnajaran' order by `tanggal` DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Donasi($thnajaran)
		{
			$t=$this->db->query("select * from `donasi` where `thnajaran` = '$thnajaran' order by `tanggal` DESC");
			return $t;
		}
		
}
