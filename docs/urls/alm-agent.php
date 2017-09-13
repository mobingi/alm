<?php

/**
* @path https://learn.mobingi.com/alm-agent/...
*
*/

$app->group('/alm-agent', function () {

    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/overview.php', [
            'title' => 'Overview - ALM agent'
        ]);

    });

    $this->get('/getting-started', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/getting-started.php', [
            'title' => 'Getting Started - ALM agent'
        ]);

    });

    $this->get('/commands', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/commands.php', [
            'title' => 'Commands - ALM agent'
        ]);

    });

    $this->get('/agent', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/agent.php', [
            'title' => 'Agent - ALM agent'
        ]);

    });

    $this->get('/addons', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/addons.php', [
            'title' => 'Add-ons - ALM agent'
        ]);

    });

    $this->get('/contributing', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-agent/contributing.php', [
            'title' => 'Contributing - ALM agent'
        ]);

    });

});
