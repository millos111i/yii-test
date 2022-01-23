<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;

rmrevin\yii\fontawesome\AssetBundle::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Instruction */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Instrukcje', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instruction-view">
    
        <p>
            <?= Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Czy na pewno chcesz usunąć tą pozycję?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'author',
            'release_number',
            'release_date',
            'additional_info',
        ],
    ]) ?>
        
    <div class="card mb-3">
        <div class="card-header"><h4><?= FA::icon("list") ?> Charakterystyki</h4></div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa charakterystyki</th>
                    <th>Wartość wzorcowa</th>
                    <th>Tol-</th>
                    <th>Tol+</th>
                    <th>Jednostka</th>
                    <th>Liczba powtórzeń</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="container-items">
                <?php foreach ($model->instructionCharacteristics as $i => $modelCharacteristic): ?>
                    <tr>
                        <td>
                            <?= $modelCharacteristic->name ?>
                        </td>
                        <td>
                            <?= $modelCharacteristic->norm_value ?>
                        </td>
                        <td>
                            <?= $modelCharacteristic->add_tolerance ?>
                        </td>
                        <td>
                            <?= $modelCharacteristic->sub_tolerance ?>
                        </td>
                        <td>
                            <?= $modelCharacteristic->measure_unit ?>
                        </td>
                        <td>
                            <?= $modelCharacteristic->number_of_repetition ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
