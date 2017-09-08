<?php

/**
* @path https://docs.mobingi.com/api/v3/...
*
*/

$app->group('', function () {

    $this->get('/alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/page-alm-rbac-home.php', [
            'title' => 'ALM Rbac Documentation'
        ]);

    });

    $this->get('/what-is-alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/what-is-alm-rbac.php', [
            'title' => 'What is ALM Rbac'
        ]);

    });

    $this->get('/alm-rbac-best-practices', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-best-practices.php', [
            'title' => 'Best Practices - ALM Rbac'
        ]);

    });

    $this->get('/working-with-alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/working-with-alm-rbac.php', [
            'title' => 'Working with ALM Rbac'
        ]);

    });

    $this->get('/alm-rbac-reference', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-reference.php', [
            'title' => 'ALM Rbac Reference'
        ]);

    });

    $this->get('/alm-rbac-troubleshooting', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-troubleshooting.php', [
            'title' => 'Troubleshooting - ALM Rbac'
        ]);

    });

    $this->get('/alm-rbac-release-history', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-release-history.php', [
            'title' => 'Release History - ALM Rbac'
        ]);

    });

    $this->get('/alm-rbac-example', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-example-rbac.php', [
            'title' => 'Example Rbac - ALM Rbac'
        ]);

    });

});
