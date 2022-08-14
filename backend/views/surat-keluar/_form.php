<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Modal;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratKeluar */
/* @var $form yii\widgets\ActiveForm */

Modal::begin([
    'header' => '<h4><b>Informasi</b></h4>',
    'id' => 'modal',
    'size' => 'modal-md',
]);

echo "<div id='modalContent'></div>";
Modal::end();

?>

<div class="surat-keluar-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'no', ['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::button('Nomor terakhir', ['value' => Url::to(['/site/last']), 'class' => 'btn btn-danger', 'id' => 'modalButton']) ?>
    </div>

    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ]); ?>

        <?= $form->field($model, 'sbj')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'obj')->textInput(['maxlength' => true]) ?>

        <?php
        if (Yii::$app->user->identity->name == 'superadmin') {
            echo $form->field($model, 'pj')->dropDownList(
                ArrayHelper::map(User::find()
                    ->where(['!=', 'name', 'superadmin'])
                    ->all(),
                    'name', 'name'), ['prompt' => 'Pilih Pegawai']
            );
        } else {
            echo $form->field($model, 'pj')->textInput(['maxlength' => true, 'disabled' => true]);  
        }
        ?>

        <?php
        echo $form->field($model, 'doc')->fileInput(); 
        if ($this->title != 'Input Surat Keluar') {
            echo "Uploaded file: ".Html::a(Html::encode(substr($model->file,8)), '../'.$model->file);    
        }
        ?>

        <div class="form-group">
            <br>
            <br>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
