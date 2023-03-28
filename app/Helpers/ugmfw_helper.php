<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tgl_indo'))
{
  function tgl_indo($date) {  //---------- Script Ubah hari dan bulan indonesia
    $hari = [1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    //$hari = [1 => 'Sn','Sl','Ra','Ka','Ju','Sa','Mi'];
    $bulan = [1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli',
                   'Agustus','September','Oktober','November','Desember'];
    $split = explode('-', $date);
    $data = $hari[(int)$split[0]].', '.$split[1].' '.$bulan[(int)$split[2]].' '.$split[3];
    return $data;
  } 
}

if (!function_exists('tgl_bln_indo'))
{
  function tgl_bln_indo($date) {
    $bulan = [1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli',
                   'Agustus','September','Oktober','November','Desember'];
    $split = explode('-', $date);
    $data = $split[0].' '.$bulan[(int)$split[1]].' '.$split[2];
    return $data;
  } 
}

if (!function_exists('umur')) {
  function umur($tgl_lahir) {
    $tgl = explode("-",$tgl_lahir);
    // cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31 --> hitung hari dalam satu bulan
    $cek_jmlhr1 = cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2 = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari = $cek_jmlhr1-$tgl['0'];
    $ssbln = 12-$tgl['1']-1;
    $hari = 0;
    $bulan = 0;
    $tahun = 0;
    //hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
      $bulan = 1;
      $hari = $sshari+date('d')-$cek_jmlhr2;
    }else{
      $hari = $sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
      $bulan = ($ssbln+date('m')+$bulan)-12;
      $tahun = date('Y')-$tgl['2'];
    }else{
      $bulan = ($ssbln+date('m')+$bulan);
      $tahun = (date('Y')-$tgl['2'])-1;
    }

    $selisih = $tahun." Tahun ".$bulan." Bulan ".$hari." Hari ";
    return $selisih;
  }
}


if (!function_exists('indonesian_date')) {

  function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '') {
    if (trim($timestamp) == '') {
      $timestamp = time();
    } elseif (!ctype_digit($timestamp)) {
      $timestamp = strtotime($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace("/S/", "", $date_format);
    $pattern = [
        '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
        '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
        '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
        '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
        '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
        '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
        '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
        '/November/', '/December/',
    ];
    $replace = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
        'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
        'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
        'Oktober', 'November', 'Desember',
    ];
    $date = date($date_format, $timestamp);
    $date = preg_replace($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
  }

}

if (!function_exists('rupiah')) {

  function rupiah($nil = 0) {
    $nil = explode('.', strval($nil));
    if (isset($nil[1])) {
      $tambah = ',' . $nil[1];
    } else {
      $tambah = ',00';
    }
    $nil = $nil[0] . $tambah;
    $str1 = $nil;
    $str2 = "";
    $dot = "";
    $str = strrev($str1);
    $arr = str_split($str, 3);
    $i = 0;
    foreach ($arr as $str) {
      $str2 = $str2 . $dot . $str;
      if (strlen($str) == 3 AND $i > 0)
        $dot = '.';
      $i++;
    }
    $rp = strrev($str2);
    if ($rp != "" AND $rp > 0) {
      return "Rp. $rp";
    } else {
      return "Rp. 0,00";
    }
  }

}

if (!function_exists('selected')) {

  function selected($a, $b, $opt = 0) {
    if ($a == $b) {
      if ($opt)
        echo "checked='checked'";
      else
        echo "selected='selected'";
    }
  }

}

if (!function_exists('decode_date')) {

  function decode_date($date = "", $xsep = "-", $isep = "/") {
    if (strlen($date) < 8)
      $date = date("Y-m-d");
    list($year, $month, $day) = explode($xsep, $date);
    return "{$day}{$isep}{$month}{$isep}{$year}";
  }

}

if (!function_exists('encode_date')) {

  function encode_date($date = "", $separator = "/") {
    if (strlen($date) < 8)
      return;
    list($day, $month, $year) = explode($separator, $date);
    return "{$year}-{$month}-{$day}";
  }

}

if (!function_exists('object_to_array')) {

  function object_to_array($object) {
    if (!is_object($object) && !is_array($object))
      return $object;

    return array_map('object_to_array', (array) $object);
  }

}

if (!function_exists('modal')) {

  function modal($title, $modul, $function, $prm1 = null, $prm2 = null, $prm3 = null, $prm4 = null, $prm5 = null) {
    return site_url('ugmfw/modal/set_modal/' . $title . '/' . $modul . '/' . $function . '/' . $prm1 . '/' . $prm2 . '/' . $prm3 . '/' . $prm4 . '/' . $prm5);
  }

}


/* End of file custom_helper.php */
/* Location: ./ugmfw-app/helpers/custom_helper.php */
