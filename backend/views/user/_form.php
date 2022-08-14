<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'maxlength' => true]) ?>

    <?php
    if (Yii::$app->user->identity->name == 'superadmin') {
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
    } else {
        echo $form->field($model, 'name')->textInput(['readonly' => true]);
    }
    ?>
    
    <?php
    if (Yii::$app->user->identity->name == 'superadmin') {
        echo $form->field($model, 'employee_id')->textInput(['maxlength' => true]);
    } else {
        echo $form->field($model, 'employee_id')->textInput(['readonly' => true]);
    }
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
    if (Yii::$app->user->identity->name == 'superadmin') {
        echo $form->field($model, 'password')->passwordInput();
    } else {
        if (Yii::$app->user->identity->updated_at == 0) {
            echo $form->field($model, 'password')->passwordInput();
        }
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
