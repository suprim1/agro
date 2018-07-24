<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'PriceForm';
?>
<div class="site-index">


    <?php
    $form = ActiveForm::begin([
                'id' => 'priceForm',
                'action' => 'site/amount',
            ])
    ?>
    <?= $form->field($model, 'tolerance')->textInput() ?>
    <?= $form->field($model, 'currentPrice')->textInput() ?>
    <?= $form->field($model, 'previousPrice')->textInput() ?>

    <?= Html::submitButton('Расчитать', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>
