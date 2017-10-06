<?php

/**
* @path https://learn.mobingi.com/container/...
*
*/

$app->group('/container', function () {

    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'container/overview.php', [
            'title' => 'Overview - Container'
        ]);

    });

    $this->get('/verified-docker-images', function ($request, $response, $args) {

        return $this->view->render($response, 'container/verified-docker-images.php', [
            'title' => 'Mobingi Verified Dcoker Images - Container'
        ]);

    });

    $this->get('/custome-docker-images', function ($request, $response, $args) {

        return $this->view->render($response, 'container/custome-docker-images.php', [
            'title' => 'Custome Docker Images - Container'
        ]);

    });

    $this->get('/custome-actions', function ($request, $response, $args) {

        return $this->view->render($response, 'container/custome-actions.php', [
            'title' => 'Custome Actions - Container'
        ]);

    });

    $this->get('/log', function ($request, $response, $args) {

        return $this->view->render($response, 'container/log.php', [
            'title' => 'Log - Container'
        ]);

    });

});
