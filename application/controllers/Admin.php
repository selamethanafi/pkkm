<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date','file','fungsi'));
		$this->load->database();
		$this->load->model('Referensi_model', 'ref');
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if($tanda !="admin")
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
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard',$data);
		$this->load->view('bawah');
	}
	function unsur($kode=null,$no=null)
	{
		$data['kode'] = $kode;
		$data['no'] = $no;
		$data['judulhalaman'] = 'PENILAIAN KINERJA KEPALA MADRASAH';
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_unsur',$data);
		$this->load->view('bawah',$data);
	}
/*
	function dicapai($id=null)
	{
		$data['id'] = $id;
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_dicapai',$data);
		$this->load->view('bawah',$data);
	}
*/
   public function tambahbukti($kode=null,$no=null)
   {
		$data['kode'] = $kode;
		$data['no'] = $no;
		$data['judulhalaman'] = 'UNGGAH BUKTI PENILAIAN KINERJA KEPALA MADRASAH';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_tambah_bukti',$data);
		$this->load->view('bawah',$data);
	}
   public function ubahbukti($kode=null,$no=null,$id_bukti=null)
   {
	  	$data['kode'] = $kode;
		$data['no'] = $no;
		$data['id_bukti'] = $id_bukti;
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_ubah_bukti',$data);
		$this->load->view('bawah',$data);
	}
	public function upload($kode=null,$no=null)
	{
		$config['upload_path']          = './unggahan/';
		$config['allowed_types']        = 'gif|jpeg|jpg|png|pdf|zip|xls|xlsx|doc|docx|ods|odt';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('berkas'))
		{
				$error = array('error' => $this->upload->display_errors(), 'kode' =>$kode, 'no' => $no, 'judulhalaman' => 'Galat, unggah berkas');
				$this->load->view('admin/atas');
				$this->load->view('admin/dashboard_tambah_bukti', $error);
				$this->load->view('bawah');
		}
		else
		{
			$data['nama_bukti'] = $this->upload->data("file_name");
			$data['status'] = $this->input->post('status');
			$data['keterangan'] = $this->input->post('keterangan_berkas');
			$data['kode'] = $kode;
			$data['no'] = $no;
			$data['tipe'] = 'file';
			$this->db->insert('bukti',$data);
			redirect('admin/unsur/'.$kode.'/'.$no);
		}
	}
	public function perbaruibuktiupload($kode=null,$no=null,$id_bukti=null)
	{
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan_berkas');
		//die("update `bukti` set `keterangan` = '$keterangan', `status` = '$status' where `id` = '$id_bukti'");
		$this->db->query("update `bukti` set `keterangan` = '$keterangan', `status` = '$status' where `id` = '$id_bukti'");
		redirect('admin/unsur/'.$kode.'/'.$no);
	}
 public function konfirmhapus($kode=null,$no=null,$id=null)
   {
		$data['kode'] = $kode;
		$data['no'] = $no;
		$data['id'] = $id;
		$data['judulhalaman'] = 'KONFIRMASI MENGHAPUS BUKTI PENILAIAN KINERJA KEPALA MADRASAH';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_hapus',$data);
		$this->load->view('bawah',$data);
	}
	public function hapus($kode=null,$no=null,$id=null)
   {
       $this->db->delete('bukti', array('id' => $id));
       echo 'Deleted successfully.';
	   redirect('admin/unsur/'.$kode.'/'.$no);
   }
   public function tambahtautan($kode=null,$no=null)
   {
		$data['kode'] = $kode;
		$data['no'] = $no;
		$data['judulhalaman'] = 'KIRIM TAUTAN BUKTI PENILAIAN KINERJA KEPALA MADRASAH';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_tambah_tautan',$data);
		$this->load->view('bawah',$data);
	}
	public function tautan($kode=null,$no=null)
	{
		$data['nama_bukti'] = $this->input->post("berkas");
		$data['status'] = $this->input->post('status');
		$data['keterangan'] = $this->input->post('keterangan_berkas');
		$data['kode'] = $kode;
		$data['no'] = $no;
		$data['tipe'] = 'tautan';
		$this->db->insert('bukti',$data);
		redirect('admin/unsur/'.$kode.'/'.$no);
	}
	public function simpanpencapaian($id=null)
	{
		$dicapai = addslashes($this->input->post("dicapai"));
		$ringkasan = addslashes($this->input->post("ringkasan"));
		$this->db->query("update `instrumen` set `dicapai` = '$dicapai', `ringkasan` = '$ringkasan' where `kode` = '$id'");
		redirect('admin');
	}
	function progress()
	{
		$data["username"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Laporan Perkembangan';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_progress',$data);
		$this->load->view('bawah');
	}
	function rekomendasi($ksnp=null)
	{
		$data["username"]=$this->session->userdata('username');
		$data["nama"]=$this->session->userdata('nama');
		$data['judulhalaman'] = 'Rekomendasi Kegiatan Prioritas';
		$data['loncat'] = '';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/rekomendasi_kegiatan_prioritas',$data);
		$this->load->view('bawah');
	}
	public function arsip($nomor=null)
	{
		$ta = $this->db->query("select * from `instrumen` WHERE `kode`='$nomor'");
		if($ta->num_rows() == 0)
		{
			echo '<div class="alert alert warning">Unsur tidak ditemukan</div>';
		}
		else
		{
			if (file_exists('unggahan/'.$nomor.'.zip')) 
			{
				unlink('unggahan/'.$nomor.'.zip');
			}
			$zip = new ZipArchive();
			$zip->open('unggahan/'.$nomor.'.zip', ZipArchive::CREATE);
			$tb = $this->db->query("select * from `sub_unsur` WHERE `nomor_id`='$nomor' order by `bukti`");
			foreach($tb->result() as $b)
			{
				$id_sub = $b->id;
				$tc = $this->db->query("select * from `bukti` WHERE `nomor_sub_unsur`='$id_sub' and `status`='final' ");
				foreach($tc->result() as $c)
				{
					//$zip->addFile('unggahan/'.$c->nama_bukti);
					$options = array('add_path' => $nomor.'/', 'remove_all_path' => TRUE);
					$zip->addGlob('unggahan/'.$c->nama_bukti, 0, $options);
				}
			}
			$zip->close();
		}
		$data['nomor'] = $nomor;
		$this->load->view('admin/atas');
		$this->load->view('admin/dashboard_unduh',$data);
		$this->load->view('bawah');

	}
	public function ubahdata($kode=null,$no=null)
	{
		$datax["username"]=$this->session->userdata('username');
		$datax["nama"]=$this->session->userdata('nama');
		$datax['judulhalaman'] = 'Menyunting Sub Unsur';
		$datax['loncat'] = '';
		$datax['tahun'] = $this->ref->ambil_nilai('tahun');
		$datax['kode'] = $kode;
		$datax['no'] = $no;
		$this->load->view('admin/atas',$datax);
		$this->load->view('admin/ubah_sub_unsur',$datax);
		$this->load->view('bawah');

	}
	public function simpanunsur($kode=null,$no=null,$id=null)
	{
		$indikator = hilangkanpetik($this->input->post('indikator'));
		$data = hilangkanpetik($this->input->post('data'));
		$bukti = hilangkanpetik($this->input->post('bukti'));
		$dicapai = hilangkanpetik($this->input->post('dicapai'));
		$cacah = hilangkanpetik($this->input->post('cacah'));
		$this->db->query("update `sub_unsur` set `indikator` = '$indikator', `data` = '$data', `bukti` = '$bukti', `dicapai` = '$dicapai' , `cacah` = '$cacah' where `id` = '$id'");
		redirect('admin');
	}
	public function tambahinstrumen()
	{
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['judulhalaman'] = 'TAMBAH INSTRUMEN';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_tambah_instrumen',$data);
		$this->load->view('bawah',$data);
	}
	public function ubahinstrumen($kode=null)
	{
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['judulhalaman'] = 'TAMBAH INSTRUMEN';
		$data['kode'] = $kode;
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_ubah_instrumen',$data);
		$this->load->view('bawah',$data);
	}
	public function simpaninstrumen($id=null)
	{
		$kriteria = hilangkanpetik($this->input->post('kriteria'));
		$kode = hilangkanpetik($this->input->post('kode'));
		$urut = hilangkanpetik($this->input->post('urut'));
		$tahun = $this->ref->ambil_nilai('tahun');
		if(empty($id))
		{
			$this->db->query("insert into `instrumen` (`tahun`, `kode`, `urut`, `kriteria`) values ('$tahun', '$kode', '$urut', '$kriteria')");
		}
		else
		{
			$this->db->query("update `instrumen` set `tahun` = '$tahun', `urut` = '$urut', `kriteria` = '$kriteria' where `kode` = '$kode'");
		}
		
		redirect('admin');
	}
	public function tambahindikator($kode=null)
	{
		$data['tahun'] = $this->ref->ambil_nilai('tahun');
		$data['kode'] = $kode;
		$data['judulhalaman'] = 'TAMBAH INDIKATOR';
		$this->load->view('admin/atas',$data);
		$this->load->view('admin/dashboard_tambah_indikator',$data);
		$this->load->view('bawah',$data);
	}
	public function simpanindikator($kode=null)
	{
		$indikator = hilangkanpetik($this->input->post('indikator'));
		$data = hilangkanpetik($this->input->post('data'));
		$bukti = hilangkanpetik($this->input->post('bukti'));
		$dicapai = hilangkanpetik($this->input->post('dicapai'));
		$cacah = hilangkanpetik($this->input->post('cacah'));
		$tahun = $this->ref->ambil_nilai('tahun');
		$this->db->query("inser t into `sub_unsur` (`kode`, `tahun`, `indikator`, `data`, `bukti`, `dicapai`, `cacah`) values ('$kode', '$tahun', '$indikator', '$data', '$bukti', '$dicapai', '$cacah')");
		redirect('admin');
	}

}//akhir fungsi
?>
