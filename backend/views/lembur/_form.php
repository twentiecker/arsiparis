<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Lembur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lembur-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php
	if (Yii::$app->user->identity->name == 'superadmin') {
		echo $form->field($model, 'name')->dropDownList(
			ArrayHelper::map(User::find()
				->where(['!=', 'name', 'superadmin'])
				->all(),
				'name', 'name'), ['prompt' => 'Pilih Pegawai']
		);
	} else {
		echo $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]);
	}
	?>

	<?php
	if (Yii::$app->user->identity->name == 'superadmin') {
		echo $form->field($model, 'employee_id')->textInput(['readonly' => true]);
	} else {
		echo $form->field($model, 'employee_id')->textInput(['disabled' => true]);
	}
	?>

	<?= $form->field($model, 'date')->widget(
		DatePicker::className(), [
			'inline' => false,
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-mm-yyyy'
			]
		]); ?>

		<?= $form->field($model, 'task')->textarea(['autofocus' => true, 'rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

<?php
$script = <<< JS
$('#lembur-name').change(function() {
	var name = $(this).val();
	$.get('get-nip', { name : name }, function(data) {
		var data = $.parseJSON(data);
		// alert(data.employee_id);
		$('#lembur-employee_id').attr('value', data.employee_id);
	});
});

JS;
$this->registerJs($script);
?>
