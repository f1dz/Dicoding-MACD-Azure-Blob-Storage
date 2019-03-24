<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <a href="https://github.com/azure" target="_blank">
            <img src="https://user-images.githubusercontent.com/15990693/36123814-be1884ee-1002-11e8-9690-072cf9ab23c6.jpg" height="100px">
    </a>
    <h1 align="center">Azure Blob Storage and Azure Cognitive using Yii2</h1>
    <br>
</p>

This web is sample how to use Azure Blob Storage using Yii2 PHP Framework and was published <a href="https://ofidmacd.azurewebsites.net" target="_blank">here</a> for fulfill the submission on <a href="https://www.dicoding.com/academies/83" target="_blank">Dicoding MACD</a>.
Please use this app for studying only. 

CONFIGURATIONS
==============

Azure Blob Storage
------------------

To configure Azure Blob Storage, open ```config/params.php``` and fill up with your Azure credential
```php
<?php
return [
    'adminEmail' => 'admin@example.com',
    'azureStorageAccountName' => '<your account name>',
    'azureStorageAccountKey' => '<your key>',
    'azureStorageContainerName' => '<your container>',
];

```  
You can change ```azureStorageContainerName``` later like this:
```php
$azure = new AzureClient();
$azure->containerName = 'abc123';
``` 

Azure Cognitive
---------------
To configure Azure Cognitive, open ```config/params.php``` and put your Azure Cognitive Key:
~~~
'azureCognitiveKey' => '<your Azure Cognitive key>'
~~~ 
