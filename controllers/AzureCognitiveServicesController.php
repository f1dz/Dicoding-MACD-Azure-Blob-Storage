<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/21/19
 * Time: 16.18
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\controllers;


use app\components\azure\AzureClient;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class AzureCognitiveServicesController extends Controller
{

    public function actionIndex() {
        $azure = new AzureClient();

        $provider = new ArrayDataProvider([
            'allModels' => $azure->getBlobsAsArray(),
            'pagination' => ['pageSize' => 20],
            'sort' => ['attributes' => ['name']]
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }

    public function actionProcess($image = null){

        return $this->renderAjax('process', ['image' => $image]);
    }

}