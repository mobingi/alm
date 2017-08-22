<?php

/**
* @path https://docs.mobingi.com/api/v3/...
*
*/

$app->group('/api/v3', function () {

    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'page-apiv3.php', [
            'title' => 'API Reference (CE)'
        ]);

    });

});
