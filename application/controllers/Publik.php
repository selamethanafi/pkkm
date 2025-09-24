<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Referensi_model', 'ref');
	}
	public function index()
	{
		$data['judulhalaman'] = 'PENILAIAN KINERJA KEPALA MADRASAH';
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$this->load->view('publik/atas',$data);
		$this->load->view('publik/dashboard',$data);
		$this->load->view('bawah');
	}
}
