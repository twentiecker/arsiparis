<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratMasuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-masuk-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'no', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
            ]
        ]); ?>

        <?= $form->field($model, 'sbj')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

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
        if ($this->title != 'Input Surat Masuk') {
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
