<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: situs_model.php
// Lokasi      		: application/models
// Terakhir diperbarui	: Sen 16 Mei 2016 22:26:38 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
class Situs_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function Data_Login($user)
	{
		$query=$this->db->query("select * from tbllogin where username='$user' and aktif='Y'");
		return $query;
	}
	function Status_User($user)
	{
		$aktif = '';
		$query=$this->db->query("select * from `tbllogin` where `username` = '$user'");
		foreach($query->result() as $q)
		{
			$aktif = $q->aktif;
		}
		return $aktif;
	}
	function Update_Password($nim,$pwd)
	{
		$nim = $this->db->escape($nim);
		$pwd = $this->db->escape($pwd);
		$this->db->query("update tbllogin set psw=$pwd where username=$nim");
	}
}
?>
