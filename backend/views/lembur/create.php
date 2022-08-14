<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lembur */

$this->title = 'Input Lembur';
$this->params['breadcrumbs'][] = ['label' => 'Lembur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lembur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
