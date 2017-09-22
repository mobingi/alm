<?php

/**
* @path https://learn.mobingi.com/enterprise...
*
*/



$app->group('', function () {

    $this->get('/cli', function ($request, $response, $args) {

        return $this->view->render($response, 'cli/page-cli.php', [
            'title' => 'Use Mobingi command line'
        ]);

    });


});
