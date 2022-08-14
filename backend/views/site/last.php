<?php

use backend\models\SuratKeluar;

$last = SuratKeluar::find()
->orderBy(['no' => SORT_DESC])
->limit(1)
->one();

// echo var_dump($last);
if (empty($last)){
	$no = 0;
} else {
	$no = $last['no'];	
}
// echo "Nomor surat yang digunakan pada: ".$no;
?>

<ul>
	<li>Nomor surat keluar terakhir adalah <b><?=$no;?></b></li>
	<li>Gunakan nomor surat <b><?=$no+1;?></b> untuk input surat keluar selanjutnya</li>
</ul>
