<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true])
        ->label('Book name') ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map($this->params['authors'], 'id', 'name'))
        ->label('Author');?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
