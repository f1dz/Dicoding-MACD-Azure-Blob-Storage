<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/21/19
 * Time: 10.43
 *
 * @author Khofidin <offiedz@gmail.com>
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<div class="row">
    <div class="col-md-12">
        <div class="export-budget-form box box-primary">
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal'],
                'layout' => 'horizontal'
            ]);
            ?>
            <div class="box-body">
                <?= $form->field($model, 'file')->fileInput()->label('File'); ?>

            </div>

            <div class="box-footer">
                <?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-flat']) ?>
            </div>

            <?php ActiveForm::end() ?>

        </div>
    </div>
</div>