<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => \yii\helpers\Url::toRoute('/admin')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add book', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add reviev', ['review/create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'book',
            'author',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
