<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/20/19
 * Time: 20.06
 *
 * @author Khofidin <offiedz@gmail.com>
 * @var $this View
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Azure Cognitive Services';

?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->title ?></h3>
                </div>
                <div class="panel-body">
                    <p>
                        <?= Html::a('<i class="fa fa-plus"></i> Add File', ['/azure-blob-storage/upload'],
                            ['class' => 'btn btn-success btn-modal', 'title'=> 'Add File']) ?>
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
                            ['header' => 'Action', 'format' => 'raw', 'value' => function ($data) {
                                if (in_array($data['contentType'], ['image/jpeg', 'image/png'])) {
                                    return Html::a('Process Cognitive',
                                        ['/azure-cognitive-services/process', 'image' => $data['url']],
                                        [
                                            'class' => 'btn btn-success btn-sm btn-modal',
                                            'title' => 'Azure Cognitive',
                                        ]);
                                } else return '';
                            }]
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
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>