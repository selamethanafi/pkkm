<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Fungsi - Fungsi Helpers
 * 
 * @author		Selamet Hanafi
 */

// ------------------------------------------------------------------------
if ( ! function_exists('angka_jadi_bulan'))
{
	function angka_jadi_bulan($postedmonth)
	{
		$bulan='';
		if ($postedmonth=="01")
			{
			$bulan = "Januari";
			}
		if ($postedmonth=="02")
			{
			$bulan = "Februari";
			}
		if ($postedmonth=="03")
			{
			$bulan = "Maret";
			}
		if ($postedmonth=="04")
			{
			$bulan = "April";
			}
		if ($postedmonth=="05")
			{
			$bulan = "Mei";
			}
		if ($postedmonth=="06")
			{
			$bulan = "Juni";
			}
		if ($postedmonth=="07")
			{
			$bulan = "Juli";
			}
		if ($postedmonth=="08")
			{
			$bulan = "Agustus";
			}
		if ($postedmonth=="09")
			{
			$bulan = "September";
			}
		if ($postedmonth=="10")
			{
			$bulan = "Oktober";
			}
		if ($postedmonth=="11")
			{
			$bulan = "November";
			}
		if ($postedmonth=="12")
			{
			$bulan = "Desember";
			}
		return $bulan;	
	}
}

if ( ! function_exists('xhuruff'))
{
//angka ke huruf
function xhuruff($str)
	{
	$search = array ("'1'",
				"'2'",
				"'3'",
				"'4'",
				"'5'",
				"'6'",
				"'7'",
				"'8'",
				"'9'",
				"'0'");

	$replace = array ("SATU",
				"DUA",
				"TIGA",
				"EMPAT",
				"LIMA",
				"ENAM",
				"TUJUH",
				"DELAPAN",
				"SEMBILAN",
				" ");

	$str = preg_replace($search,$replace,$str);
	return $str;
	}
}
if ( ! function_exists('dengan_huruf'))
{
//angka ke huruf
function dengan_huruf($str)
	{
	$search = array ("'1'",
				"'2'",
				"'3'",
				"'4'",
				"'5'",
				"'6'",
				"'7'",
				"'8'",
				"'9'",
				"'0'");

	$replace = array ("satu",
				"dua",
				"tiga",
				"empat",
				"lima",
				"enam",
				"tujuh",
				"delapan",
				"sembilan",
				"nol");

	$str = preg_replace($search,$replace,$str);
	return $str;
	}
}
if ( ! function_exists('xhuruf'))
{
//angka ke huruf
function xhuruf($str)
	{
	$search = array ("'1'","'2'","'3'","'4'","'5'","'6'","'7'","'8'","'9'","'0'");
	$replace = array ("satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh");
	if (strlen($str>1))
		{
		$str .= "  ".preg_replace($search,$replace,$str);
		}
		else
		{
		$str .= " ".preg_replace($search,$replace,$str);
		}
	return $str;
	}
}
if ( ! function_exists('date_to_long_string'))
{
	function date_to_long_string($tanggale)
	{
		$str= $tanggale;
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		if($postedday<10)
		{
			$postedday = substr($postedday,-1);
		}
		$bulan='';
		if ($postedmonth=="01")
			{
			$bulan = "Januari";
			}
		if ($postedmonth=="02")
			{
			$bulan = "Februari";
			}
		if ($postedmonth=="03")
			{
			$bulan = "Maret";
			}
		if ($postedmonth=="04")
			{
			$bulan = "April";
			}
		if ($postedmonth=="05")
			{
			$bulan = "Mei";
			}
		if ($postedmonth=="06")
			{
			$bulan = "Juni";
			}
		if ($postedmonth=="07")
			{
			$bulan = "Juli";
			}
		if ($postedmonth=="08")
			{
			$bulan = "Agustus";
			}
		if ($postedmonth=="09")
			{
			$bulan = "September";
			}
		if ($postedmonth=="10")
			{
			$bulan = "Oktober";
			}
		if ($postedmonth=="11")
			{
			$bulan = "November";
			}
		if ($postedmonth=="12")
			{
			$bulan = "Desember";
			}
		$tanggalpanjang = "$postedday $bulan $postedyear";	

		return $tanggalpanjang;	
	}
}

if ( ! function_exists('satuan'))
{
	function satuan($str)
	{
		if ($str == '1')
			{
			$str = 'satu';
			}
		if ($str == '2')
			{
			$str = 'dua';
			}
		if ($str == '3')
			{
			$str = 'tiga';
			}
		if ($str == '4')
			{
			$str = 'empat';
			}
		if ($str == '5')
			{
			$str = 'lima';
			}
		if ($str == '6')
			{
			$str = 'enam';
			}
		if ($str == '7')
			{
			$str = 'tujuh';
			}
		if ($str == '8')
			{
			$str = 'delapan';
			}
		if ($str == '9')
			{
			$str = 'sembilan';
			}
		return  $str;
		
	
	}
}
if ( ! function_exists('number_to_long_string'))
{
	function number_to_long_string($str)
	{
	if ($str == 0)
		{
		$str = "";
		}
	else if (strlen($str) == 1)
		{
		$str = satuan($str);
		}
		else
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,1,1);
		if ($str=="10")
			{
			$str = "sepuluh";
			return $str;
			}
		elseif ($str=="100")
			{
			$str = "seratus";
			return $str;
			}
		else if ($str == "11")
			{
			$str = "sebelas";
			return $str;

			}

		else if (($nil1 == "1") and ($nil2 > 1))
			{
			if ($nil2 == 2)
				{$str = "DUA BELAS";}
			if ($nil2 == 3)
				{$str = "TIGA BELAS";}
			if ($nil2 == 4)
				{$str = "EMPAT BELAS";}
			if ($nil2 == 5)
				{$str = "LIMA BELAS";}
			if ($nil2 == 6)
				{$str = "ENAM BELAS";}
			if ($nil2 == 7)
				{$str = "TUJUH BELAS";}
			if ($nil2 == 8)
				{$str = "delapan BELAS";}
			if ($nil2 == 9)
				{$str = "sembilan BELAS";}

			}

		else
		{
			if ($nil2 == 0)
				{
				$str = satuan($nil1).' puluh';
				}
				else
				{
				$str = satuan($nil1).' puluh '.satuan($nil2);
				}
		}
		} // akhir kalau lebih dari 1 digit

//		$str = $nil1.'-'.$nil2;
	return $str;
	}

}
if ( ! function_exists('cari_thnajaran'))
{
	function cari_thnajaran()
	{

		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		if (($bulany=='07') or ($bulany=='08') or ($bulany=='09') or ($bulany=='10') or ($bulany=='11') or ($bulany=='12'))
		{
			$thnajaran = $tahuny;
		}
		else
		{
			$tahuny1 = $tahuny-1;
			$thnajaran = $tahuny1;
		}
		//$thnajaran = '2018/2019';
		return $thnajaran;
	}
}

if ( ! function_exists('cari_semester'))
{
	function cari_semester()
	{

		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		if (($bulany=='07') or ($bulany=='08') or ($bulany=='09') or ($bulany=='10') or ($bulany=='11') or ($bulany=='12'))
		{
			$semester= '1';
		}
		else
		{
			$semester= '2';
		}
		//$semester='2';
		return $semester;
	}
}

if ( ! function_exists('berkas'))
{
	function berkas($str) 
	{
	$str = preg_replace("/ /","_", $str);
	$str = preg_replace("/`/","", $str);
	$str = preg_replace("/\'/","", $str);
	$str = preg_replace("/,/","", $str);
	$str = preg_replace("/\./","_", $str);
	$str = preg_replace("/\//","_", $str);
	return $str;
  	}
}
if ( ! function_exists('nopetik'))
{
	function nopetik($str) 
	{
	$str = preg_replace("/’/","", $str);
	$str = preg_replace("/'/","`", $str);
	return $str;
  	}
}

if ( ! function_exists('bersihkan'))
{
	function bersihkan($str) 
	{
	$str = preg_replace("/ /","_", $str);
	$str = preg_replace("/'/","`", $str);
	$str = preg_replace("/,/","_", $str);
	$str = preg_replace("/\./","_", $str);
	$str = preg_replace("/\//","_", $str);
	return $str;
  	}
}

if ( ! function_exists('tanggal_ke_hari'))
{
	function tanggal_ke_hari($str) 
	{
	$dinane='?';
	if(strlen($str)==10)
	{
	$x = substr($str,0,4);
	$y = substr($str,5,2);
	$z = substr($str,8,2);
	$dina = date("l", mktime(0, 0, 0, $y, $z, $x));

	if ($dina == 'Sunday')
		{
		$dinane = 'Minggu';
		}
	if ($dina == 'Monday')
		{
		$dinane = 'Senin';
		}
	if ($dina == 'Tuesday')
		{
		$dinane = 'Selasa';
		}
	if ($dina == 'Wednesday')
		{
		$dinane = 'Rabu';
		}
	if ($dina == 'Thursday')
		{
		$dinane = 'Kamis';
		}
	if ($dina == 'Friday')
		{
		$dinane = 'Jumat';
		}
	if ($dina == 'Saturday')
		{
		$dinane = 'Sabtu';
		}
	}
	return $dinane;
  	}
}

if ( ! function_exists('day_to_hari'))
{
	function day_to_hari($dina) 
	{
	$dinane='';
	if ($dina == 'Sunday')
		{
		$dinane = 'Minggu';
		}
	if ($dina == 'Monday')
		{
		$dinane = 'Senin';
		}
	if ($dina == 'Tuesday')
		{
		$dinane = 'Selasa';
		}
	if ($dina == 'Wednesday')
		{
		$dinane = 'Rabu';
		}
	if ($dina == 'Thursday')
		{
		$dinane = 'Kamis';
		}
	if ($dina == 'Friday')
		{
		$dinane = 'Jumat';
		}
	if ($dina == 'Saturday')
		{
		$dinane = 'Sabtu';
		}

	return $dinane;
  	}
}
if ( ! function_exists('tanggal_hari_ini'))
{
	function tanggal_hari_ini() 
	{
		$tahuny = date("Y");
		$bulany = date("m");
		$tanggaly = date("d");
		$tanggalhariini = "$tahuny-$bulany-$tanggaly";
		//$tanggalhariini = '2016-01-31';
	return $tanggalhariini;
  	}
}
if ( ! function_exists('via_curl'))
{
	function via_curl($url_ard_unduh)
	{
		$file = $url_ard_unduh;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$xmldata = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($xmldata, true);
		return $json;	
	}
}
if ( ! function_exists('tanggal'))
{
	function tanggal($str)
	{
		$postedyear=substr($str,0,4);
		$postedmonth=substr($str,5,2);
  		$postedday=substr($str,8,2);
		$tanggalbiasa = $postedday.'-'.$postedmonth.'-'.$postedyear;	
		return $tanggalbiasa;	
	}
}
if ( ! function_exists('hilangkanpetik'))
{
	function hilangkanpetik($str) 
	{
	$str = preg_replace("/'/","", $str);
	return $str;
  	}
}
if ( ! function_exists('kode_ke_snp'))
{
	function kode_ke_snp($str) 
	{
		if($str == 'si')
		{
			$str = 'Pengembangan Standar Isi';
		}elseif($str == 'spr')
		{ $str = ' Standar Proses'; }
		elseif($str == 'spn') 
		{ $str = ' Standar Penilaian Pendidikan'; } 
		elseif($str == 'skl') 
		{ $str = ' Standar Kompetensi Lulusan'; }
		elseif($str == 'sptp') 
		{ $str = ' Standar Pendidik dan Tenaga Kependidikan'; }
		elseif($str == 'spl') 
		{ $str = ' Standar Pengelolaan'; } 
		elseif($str == 'spb') 
		{ $str = ' Standar Pembiayaan Pendidikan'; }
		elseif($str == 'ssp') 
		{ $str = ' Standar Sarana dan Prasarana'; } 
		else
		{
			$str = '???';
		}
	return $str;
  	}
	if ( ! function_exists('xduit'))
{
//pencacah bilangan duit
function xduit($str)
	{
	//bernilai 2 digit
	if (strlen($str) == 0 )
		{
		$rupiah = "";
		}
	elseif (strlen($str) < 3 )
		{
		$rupiah = "$str,00";
		}

	//bernilai 3 digit
	else if (strlen($str) == 3)
		{
		$nil1 = substr($str,-3);
		$rupiah = "$nil1,00";
		}

	//bernilai 4 digit
	else if (strlen($str) == 4)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,-3);
		$rupiah = "$nil1.$nil2,00";
		}


	//jika ada 5 digit
	else if (strlen($str) == 5)
		{
		$nil1 = substr($str,0,2);
		$nil2 = substr($str,-3);
		$rupiah = "$nil1.$nil2,00";
		}

	//jika ada 6 digit
	else if (strlen($str) == 6)
		{
		$nil1 = substr($str,0,3);
		$nil2 = substr($str,-3);
		$rupiah = "$nil1.$nil2,00";
		}

	//jika ada 7 digit
	else if (strlen($str) == 7)
		{
		$nil1 = substr($str,0,1);
		$nil2 = substr($str,1,3);
		$nil3 = substr($str,-3);
		$rupiah = "$nil1.$nil2.$nil3,00";
		}

	//jika ada 8 digit
	else if (strlen($str) == 8)
		{
		$nil1 = substr($str,0,2);
		$nil2 = substr($str,2,3);
		$nil3 = substr($str,-3);
		$rupiah = "$nil1.$nil2.$nil3,00";
		}

	//jika ada 9 digit
	else if (strlen($str) == 9)
		{
		$nil1 = substr($str,0,3);
		$nil2 = substr($str,3,3);
		$nil3 = substr($str,-3);
		$rupiah = "$nil1.$nil2.$nil3,00";
		}
	return $rupiah;
	}
	
}
if ( ! function_exists('tahun'))
{
	function tahun($str)
	{
		$tahun ='';
		$CI =& get_instance();
		$CI->load->model('Helper_model');
		$tahun = $CI->Helper_model->tahun($str);
		return $tahun;
	}
}

}
// ------------------------------------------------------------------------


/* End of file fungsi_helper.php */
/* Location: ./system/helpers/fungsi_helper.php */
