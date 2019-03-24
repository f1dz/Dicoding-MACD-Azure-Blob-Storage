<?php
/**
 * Created by PhpStorm.
 * User: ofid
 * Date: 03/21/19
 * Time: 16.30
 *
 * @author Khofidin <offiedz@gmail.com>
 */

?>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <p class="well" id="description"></p>
                <div class="col-md-5">
                    <img id="sourceImage" width="300"/>
                </div>
                <div class="col-lg-7">
                    <textarea id="responseTextArea" class="UIInput"
                              style="width:100%; height:400px; bottom: 0;"></textarea>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
<?php
$this->registerJs("
    processImage();
    function processImage() {
      // **********************************************
      // *** Update or verify the following values. ***
      // **********************************************

      // Replace <Subscription Key> with your valid subscription key.
      var subscriptionKey = '896a4f7b8f164e9eaf32068cea214e2c';

      var uriBase = 'https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze';

      // Request parameters.
      var params = {
        'visualFeatures': 'Categories,Description,Color',
        'details': '',
        'language': 'en',
      };

      // Display the image.
      var sourceImageUrl = '$image'; //document.getElementById('inputImage').value;
      document.querySelector('#sourceImage').src = sourceImageUrl;

      // Make the REST API call.
      $.ajax({
        url: uriBase + '?' + $.param(params),

        // Request headers.
        beforeSend: function (xhrObj) {
          xhrObj.setRequestHeader('Content-Type', 'application/json');
          xhrObj.setRequestHeader(
            'Ocp-Apim-Subscription-Key', subscriptionKey);
        },

        type: 'POST',

        // Request body.
        data: '{\"url\": ' + '\"' + sourceImageUrl + '\"}',
      })

        .done(function (data) {
          // Show formatted JSON on webpage.
          $('#responseTextArea').val(JSON.stringify(data, null, 2));
          $('.progress').hide();
          document.getElementById('description').innerHTML = data.description.captions[0].text;
        })

        .fail(function (jqXHR, textStatus, errorThrown) {
          // Display error message.
          var errorString = (errorThrown === '') ? 'Error. ' :
            errorThrown + ' (' + jqXHR.status + '): ';
          errorString += (jqXHR.responseText === '') ? '' :
            jQuery.parseJSON(jqXHR.responseText).message;
          alert(errorString);
        });
    };
");
?>