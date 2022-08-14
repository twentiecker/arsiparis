<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h3><b>Syarat dan Ketentuan Lembur</b></h3>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'>
<ul>
<li>Absen pagi di kantor maksimal jam 08.00</li>
<li>Absen pulang di kantor minimal jam 17.00</li>
<li>Jika memang lembur di kantor, maka absen pulang wajib di kantor dan jangan absen lagi di rumah (karena jumlah jam lembur akan bertambah)</li>
<li>Lembur yang dapat diajukan maksimal 6 setiap bulan</li>
</ul>
</div>";
Modal::end();

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Arsiparis | <?= date('Y') ?></h1>

        <p class="lead">"Administrasi/surat-menyurat masuk dan keluar dari dan ke (disposisi) <br>serta kegiatan lembur Subdit NRTIN."</p>

        <p><a class="btn btn-lg btn-primary" href="#"></a> <a class="btn btn-lg btn-success" href="#"></a> <a class="btn btn-lg btn-warning" href="#"></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Lembur</h2>

                <p>Menu ini digunakan untuk melakukan input pengajuan lembur dengan menyertakan agenda/kegiatan yang dilakukan selama lembur.</p>

                <p><a class="btn btn-default" id="modalButton">Selengkapnya &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Surat Keluar</h2>

                <p>Menu ini digunakan untuk melakukan input surat keluar dengan menyertakan softcopy surat yang akan diupload pada form yang sudah disediakan.</p>

            </div>
            <div class="col-lg-4">
                <h2>Surat Masuk</h2>

                <p>Menu ini digunakan untuk melakukan input surat masuk dengan menyertakan softcopy surat yang akan diupload pada form yang sudah disediakan.</p>

            </div>
        </div>

    </div>
</div>
