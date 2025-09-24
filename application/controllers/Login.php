<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Dimutakhirkan	: Sen 04 Jan 2016 07:55:56 WIB 
// Nama Berkas 		: Login.php
// Lokasi      		: application/views/controller/
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

class Login extends CI_Controller {
 function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','string','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model', 'ref');
	}

	function index()
	 {
		$tanda = $this->session->userdata('tanda');
		if(isset($tanda))
		{
			if($tanda=="admin"){
				redirect('admin');
			}
			elseif($tanda=="PA"){
				redirect('admin');
			}
			else {
				redirect(base_url());
			}

		}
		$data = array();
		$data['sek_nama'] = $this->config->item('sek_nama');
		$this->load->view('login',$data);	
	 }
	function masuk()
	{
		$username = nopetik($this->input->post('usernameteks'));
		$psw = $this->input->post('passwordteks');
		$captcha = $this->input->post('captcha');
		// First, delete old captchas
		$expiration = time()-600; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		$oke = 1;
		if ($row->count == 0)
		{
		    $oke = 0;
		}
		$this->load->model('Situs_model');
		$password = 0;
		$pswhash = '';
		$hasil = $this->Situs_model->Data_Login($username);
		$ada = $hasil->num_rows();
		if (count($hasil->result_array())>0)
		{
			foreach($hasil->result() as $dh)
			{
				$pswhash = $dh->psw;
			}
			if (password_verify($psw, $pswhash)) 
			{
			    $password = 1;
			}
		}
		if (($password == 1) and ($oke == 1)){
			foreach($hasil->result() as $user){
				$data = array(
		                'username' => $user->username,
		                'nama' => $user->nama,
		                'login_status' => true,
		                'tanda' => $user->status,
            	);
			}
		        $this->session->set_userdata($data);
			$tanda = $this->session->userdata('tanda');
			if($tanda=="admin"){
				redirect('admin');
			}
			elseif($tanda=="supervisor"){
				redirect('supervisor');
			}
			else {
				redirect(base_url());
			}
		}
		else
		{
			$client_id = $this->ref->ambil_nilai('client_id');
			$secret_id = $this->ref->ambil_nilai('secret_id');
			$simamad = $this->ref->ambil_nilai('simamad');
			$params=[
				'client_id'=>$client_id,
				'secret_id'=>$secret_id,
				'username' => $username,
				'password'=> $psw,
			];
			$ch = curl_init($simamad.'/login/logindarisemua');
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$json = curl_exec($ch);
			//echo $json;//.$simamad.'/login/logindarisemua';
			if(!$json)
			{
				die("galat, gagal menyambung ke sistem informasi madrasah");
			}
			curl_close($ch);
			$json2 = json_decode($json, true);
			//echo '<pre>'.$json2.'</pre>';
			$login_status = 0;
			$username2 = '';
			$sebagai = '';
			$nama = '';
			foreach($json2 as $dta)
			{
				$login_status = $dta['login_status'];
				$tanda = $dta['tanda'];
				$nama = $dta['nama'];
				$nuptk = $dta['nuptk'];
				$kelas = $dta['kelas'];
			}
			//		echo $login_status.' '.$nama.' '.$secret_id.' '.$client_id.' '.$username.' '.$psw;
			if($login_status == 1)
			{
				$data = array(
		                'username' => $username,
		                'nama' => $nama,
		                'nuptk' => $nuptk,
		                'tanda' => $tanda,
		                'kelas' => $kelas,
            			);
			        $this->session->set_userdata($data);
				$tanda = $this->session->userdata('tanda');
				if($tanda=="PA")
				{
					redirect('pa');
				}
				else
				{
					session_destroy();
					echo 'Bukan Guru';
				}

			}
			else
			{
			$data['sek_nama'] = $this->config->item('sek_nama');
			$data['galat'] = 'Username, password, kode keamanan yang Anda masukkan Salah atau belum diaktifkan..!!!';
			$this->load->view('login', $data);	
			}
		}
	}
	function updatepassworduser()
	{
		$noseluler=hilangkanpetik($this->input->post('noseluler'));
		$psw=hilangkanpetik($this->input->post('pwd'));
		$psw1 = $psw;
		$this->load->model('Situs_model');
		$username = $this->Situs_model->Seluler_Jadi_Username($noseluler);
		$this->Situs_model->Hapus_Reset($noseluler);				
		$options = array('cost' => 8);
			if(!empty($psw))
			{
				$psw = password_hash($psw, PASSWORD_BCRYPT, $options);
			}
		$this->Situs_model->Update_Password($username,$psw);
		echo "<font size='2' face='arial'>Sukses memperbarui password.<br> Password baru Anda : <b>".$psw1." ".$psw."</b><br>
			Dengan username : <b>".$username.",</b><br>";
		echo 'Silakan login di <a href="'.base_url().'index.php/login"><strong>sini</strong></a>';
	}
	function logout()
	{
		session_destroy();
		redirect('login');
	}
}
