<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */
/* @var $authors array */

$this->title = 'Create Authors';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => \yii\helpers\Url::toRoute('/admin')];
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['admin/authors/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors
    ]) ?>

</div>
