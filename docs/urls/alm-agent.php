<?php

/**
* @path https://learn.mobingi.com/alm-agent/...
*
*/

$app->group('/alm-agent', function () {

    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/overview.php', [
            'title' => 'Overview - Alm-agent'
        ]);

    });

    $this->get('/getting-started', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/getting-started.php', [
            'title' => 'Getting Started - Alm-agent'
        ]);

    });

    $this->get('/commands', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/commands.php', [
            'title' => 'Commands - Alm-agent'
        ]);

    });

    $this->get('/agent', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/agent.php', [
            'title' => 'Agent - Alm-agent'
        ]);

    });

    $this->get('/addons', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/addons.php', [
            'title' => 'Add-ons - Alm-agent'
        ]);

    });

    $this->get('/contributing', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/contributing.php', [
            'title' => 'Contributing - Alm-agent'
        ]);

    });

});
