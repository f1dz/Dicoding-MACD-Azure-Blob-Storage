<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/20/19
 * Time: 20.04
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\controllers;


use app\components\azure\AzureClient;
use Yii;
use yii\base\DynamicModel;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class AzureBlobStorageController extends Controller
{
    public function actionIndex()
    {
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

    public function actionUpload(){

        $model = new DynamicModel(['file', 'savedFile']);
        $model->addRule(['file'], 'required', ['class' => 'form-control']);
        $model->addRule(['file'], 'file');
        $model->addRule(['savedFile'], 'safe');

        if($model->load(Yii::$app->request->post())){

            $model->file = UploadedFile::getInstance($model, 'file');

            $azure = new AzureClient();
            $azure->fileToUpload = $model;
            $azure->upload();

            Yii::$app->session->setFlash('success', 'File successfully uploaded');
            return $this->redirect('/azure-blob-storage');
        }


        return $this->renderAjax('upload', ['model' => $model]);
    }
}