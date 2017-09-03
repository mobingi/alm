<?php

/**
* @path https://docs.mobingi.com/api/v3/...
*
*/

$app->group('', function () {

    $this->get('/alm-template', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/page-alm-template-home.php', [
            'title' => 'ALM Template Documentation'
        ]);

    });

    $this->get('/what-is-alm-template', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/what-is-alm-template.php', [
            'title' => 'What is ALM Template'
        ]);

    });

    $this->get('/alm-template-best-practices', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/alm-template-best-practices.php', [
            'title' => 'Best Practices - ALM Template'
        ]);

    });

    $this->get('/working-with-alm-templates', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/working-with-alm-templates.php', [
            'title' => 'Working with ALM Template'
        ]);

    });

    $this->get('/alm-templates-reference', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/alm-templates-reference.php', [
            'title' => 'ALM Template Reference'
        ]);

    });

    $this->get('/alm-templates-troubleshooting', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/alm-templates-troubleshooting.php', [
            'title' => 'Troubleshooting - ALM Template'
        ]);

    });

    $this->get('/alm-templates-release-history', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/alm-templates-release-history.php', [
            'title' => 'Release History - ALM Template'
        ]);

    });

    $this->get('/alm-templates-example-templates', function ($request, $response, $args) {

        return $this->view->render($response, 'alm-template/alm-templates-example-templates.php', [
            'title' => 'Example Templates - ALM Template'
        ]);

    });

});
