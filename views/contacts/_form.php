<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/script.js', ['depends' => 'yii\web\YiiAsset']);
?>

<div class="contact-form" <?= (isset($model)) ? 'data-current-action="update"' : 'data-current-action="create"'?>>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_date')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'endDate' => date('Y-m-d', strtotime('-18 years'))
        ]
    ]);?>

    <?= $form->field($model, 'number')->textInput(
            [
                'maxlength' => true,
                'value' => isset($numbers) ? $numbers[0]->number : '',
                'name' => 'ContactForm[number][0]',
                'class' => 'form-control phone-number-input'
            ]) ?>

    <div class="form-group">
        <div id="phone-numbers-container">
            <?php if (isset($model) && isset($numbers) && count($numbers) > 1) : ?>
                <?php foreach ($numbers as $key => $number) : ?>
                    <?php if($key == 0) continue; ?>
                    <div class="form-group" id="form-group-<?=$key?>">
                        <label class="control-label" for="phone-number-<?=$key?>">Phone number</label>
                        <div class="row">
                            <div class="col-sm-11">
                                <input type="text" id="phone-number-<?=$key?>" class="form-control phone-number-input" name="ContactForm[number][<?=$key?>]" maxlength="13" value="<?=$number->number?>">
                            </div>
                            <div class="col-sm-1">
                                <div class="btn btn-danger delete-btn" data-index="<?=$key?>">Delete</div>
                            </div>
                        </div>

                        <div class="help-block"></div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <p>
            <?= Html::button('Add One More Number', ['class' => 'btn btn-primary', 'id' => 'add-number-button']) ?>
        </p>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
