<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\jui\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use rmrevin\yii\fontawesome\FA;

rmrevin\yii\fontawesome\AssetBundle::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Instruction */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mb-5">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'release_number')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'release_date')->widget(DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'language' => 'pl_PL',
                'options'=>['class'=>'form-control']
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'additional_info')->textArea(['maxlength' => true, 'placeholder' => 'Informacje dodatkowe...']) ?>
    
    <div class="card mb-3">
        <div class="card-header"><h4><?= FA::icon("list") ?> Charakterystyki</h4></div>
        <div class="card-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items',
                'widgetItem' => '.item',
                'insertButton' => '.add-item',
                'deleteButton' => '.remove-item',
                'model' => $modelsCharacteristic[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'name',
                    'norm_value',
                    'add_tolerance',
                    'sub_tolerance',
                    'measure_unit',
                    'number_of_repetition',
                ],
            ]); ?>

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
                    <?php foreach ($modelsCharacteristic as $i => $modelCharacteristic): ?>
                        <tr class="item">
                            <?php
                                // necessary for update action.
                                if (! $modelCharacteristic->isNewRecord) {
                                    echo Html::activeHiddenInput($modelCharacteristic, "[{$i}]id");
                                }
                            ?>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]name")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]norm_value")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]add_tolerance")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]sub_tolerance")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]measure_unit")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelCharacteristic, "[{$i}]number_of_repetition")->textInput(['maxlength' => true])->label(false) ?>
                            </td>
                            <td>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><?= FA::icon("times") ?></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><button type="button" class="add-item btn btn-success text-nowrap"><span class="fa fa-plus"></span> Dodaj charakterystyke</button></td>
                    </tr>
                </tfoot>
            </table>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
