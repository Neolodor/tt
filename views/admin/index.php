<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Authors', '/admin/authors', ['class' => 'btn btn-primary']);?>
        <?= Html::a('Books', '/admin/books', ['class' => 'btn btn-primary']);?>
    </p>
</div>