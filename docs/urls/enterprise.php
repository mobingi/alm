<?php

/**
* @path https://docs.mobingi.com/enterprise...
*
*/

// Enterprise Default Homepage

$app->group('/enterprise', function () {

    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-home.php', [
            'title' => 'Mobingi Documentation Site (EE)'
        ]);

    });

    $this->get('/api', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-api.php', [
            'title' => 'API Reference (EE)'
        ]);

    });

});
