<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/21/19
 * Time: 14.12
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\commands;


use app\components\azure\AzureClient;
use Yii;
use yii\console\Controller;

class AzureController extends Controller
{

    public function actionUpload(){
        $azure = new AzureClient();
        $azure->fileToUpload = Yii::getAlias('@app/uploads'). DIRECTORY_SEPARATOR . '2017-12-21-PHOTO-00000699.jpg';
        $azure->upload();
    }

}