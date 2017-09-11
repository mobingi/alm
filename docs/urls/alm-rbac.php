<?php

/**
* @path https://docs.mobingi.com/api/v3/...
*
*/

$app->group('', function () {

    $this->get('/alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-home.php', [
            'title' => 'Role Based Access Control Documentation'
        ]);

    });

    $this->get('/what-is-alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/what-is-alm-rbac.php', [
            'title' => 'What is Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-getting-started', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-getting-started.php', [
            'title' => 'Getting Started - Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-best-practices', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-best-practices.php', [
            'title' => 'Best Practices - Role Based Access Control'
        ]);

    });

    $this->get('/working-with-alm-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/working-with-alm-rbac.php', [
            'title' => 'Working with Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-reference', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-reference.php', [
            'title' => 'Reference - Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-troubleshooting', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-troubleshooting.php', [
            'title' => 'Troubleshooting - Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-release-history', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-release-history.php', [
            'title' => 'Release History - Role Based Access Control'
        ]);

    });

    $this->get('/alm-rbac-example-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-rbac/alm-rbac-example-rbac.php', [
            'title' => 'Example Roles - Role Based Access Control'
        ]);

    });

});
