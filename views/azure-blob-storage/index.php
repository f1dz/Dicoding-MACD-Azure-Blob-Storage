<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/20/19
 * Time: 20.06
 *
 * @author Khofidin <offiedz@gmail.com>
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Azure Blobs Storage';

?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">List of Blob Files</h3>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('<i class="fa fa-plus"></i> Add File', ['upload'],
                        ['class' => 'btn btn-success btn-modal', 'title'=> 'Add File']) ?>
                    <?= Html::a('<i class="fa fa-cloud"></i> Cognitive Service', ['/azure-cognitive-services'],
                        ['class' => 'btn btn-success']) ?>
                </p>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $provider,
                    'layout' => '{items}{summary}{pager}',
                    'options' => ['class' => 'table-responsive'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['header' => 'File Name', 'value' => 'name'],
                        ['header' => 'Url', 'format' => 'raw', 'value' => function ($data) {
                            return Html::a($data['url'], $data['url'], ['target' => '_blank']);
                        }],
                        ['header' => 'Type', 'value' => 'contentType'],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
<?php
Modal::begin([
    'options' => ['tabindex' => false,],
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>