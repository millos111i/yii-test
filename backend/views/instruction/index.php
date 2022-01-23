<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instrukcje';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Utwórz instrukcję', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'author',
            'release_number',
            'release_date',
            //'additional_info',
            [
                'class' => ActionColumn::className()
            ],
        ],
    ]); ?>

</div>
