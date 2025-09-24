<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supervisor extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model', 'ref');
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="supervisor")
			{
			redirect('login');
			}
		}
		else
		{
			redirect('login');
		}


	}
	function index()
	{
		$data["username"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'PENILAIAN KINERJA KEPALA MADRASAH';
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$this->load->view('supervisor/atas',$data);
		$this->load->view('supervisor/dashboard',$data);
		$this->load->view('bawah');
	}
	function nilai($kode=null, $no=null)
	{
		$data["username"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'PENILAIAN KINERJA KEPALA MADRASAH';
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['kode'] = $kode;
		$data['no'] = $no;
		$this->load->view('supervisor/atas',$data);
		$this->load->view('supervisor/nilai',$data);
		$this->load->view('bawah');
	}
	public function simpan($kode=null,$no=null)
	{
		$nilai = $this->input->post('nilai');
		$tahun = $this->ref->ambil_nilai('tahun');
		$this->db->query("update `nilai` set `dicapai` = '$nilai' where `kode` = '$kode' and `no` = '$no' and `tahun` = '$tahun'");
		redirect('supervisor');
	}
	public function cetaknilai()
	{
		$data["username"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data["namasupervisor"]=$this->session->userdata('nama');
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['judulhalaman'] = 'REKAPITULASI PENILAIAN KINERJA KEPALA MADRASAH';
		$this->load->view('mencetak_nilai_pkkm',$data);
	}
	public function cetak()
	{
		$data["username"]=$this->session->userdata('username');
		$data["namasupervisor"]=$this->session->userdata('nama');
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['judulhalaman'] = 'PENILAIAN KINERJA KEPALA MADRASAH';
		$this->load->view('mencetak_hasil_pkkm',$data);
	}

}//akhir fungsi
?>
