<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/21/19
 * Time: 06.22
 *
 * @author Khofidin <offiedz@gmail.com>
 */

namespace app\components\azure;

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Common\Exceptions\InvalidArgumentTypeException;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use Yii;
use yii\base\Component;

/**
 *
 * @property array $blobsAsArray
 * @property void $list
 */
class AzureClient extends Component
{

    private $connectionString;

    private $blobClient;

    public $containerName;

    public $fileToUpload;

    public function init()
    {

        $account = Yii::$app->params['azureStorageAccountName'];
        $key = Yii::$app->params['azureStorageAccountKey'];
        $this->containerName = $this->containerName ? $this->containerName : Yii::$app->params['azureStorageContainerName'];

        $this->connectionString = "DefaultEndpointsProtocol=https;AccountName=$account;AccountKey=$key";
        $this->blobClient = BlobRestProxy::createBlobService($this->connectionString);

        parent::init();
    }

    public function getList()
    {
        $listBlobsOptions = new ListBlobsOptions();
        $data = $this->blobClient->listBlobs('dicoding', $listBlobsOptions);
        $listBlobsOptions->setContinuationToken($data->getContinuationToken());
        return $data->getBlobs();
    }

    public function getBlobsAsArray()
    {
        $result = [];
        foreach ($this->getList() as $blob) {
            $result[] = [
                'name' => $blob->getName(),
                'url' => $blob->getUrl(),
                'contentType' => $blob->getProperties()->getContentType(),
                'lastModified' => $blob->getProperties()->getLastModified(),
            ];
        }

        return $result;
    }

    public function upload()
    {

        try {

            $content = fopen($this->fileToUpload->file->tempName, "r");

            $options = new CreateBlockBlobOptions();
            $options->setContentType($this->fileToUpload->file->type);

            //Upload blob
            $this->blobClient->createBlockBlob($this->containerName, $this->fileToUpload->file->name, $content, $options);

        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . "<br />";
        } catch (InvalidArgumentTypeException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . "<br />";
        }
    }

    public function cleanup()
    {
        try {
            // Delete container.
            echo "Deleting Container" . PHP_EOL;
            echo $_GET["containerName"] . PHP_EOL;
            echo "<br />";
            $this->blobClient->deleteContainer($_GET["containerName"]);
        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            return $code . ": " . $error_message;
        }
    }

    public function generateRandomString($length = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}