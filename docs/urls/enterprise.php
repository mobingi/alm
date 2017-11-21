<?php

/**
* @path https://learn.mobingi.com/enterprise...
*
*/



$app->group('/enterprise', function () {

    // Enterprise Default Homepage
    $this->get('', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-home.php', [
            'title' => 'Mobingi Documentation Site (EE)'
        ]);

    });

    $this->get('/get-started', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/get-started/home.php', [
            'title' => 'Get Started with ALM console (EE)'
        ]);

    });

    $this->get('/get-started/add-aws-account', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/get-started/add-aws-account.php', [
            'title' => 'How to add AWS account to ALM console (EE)'
        ]);

    });

    $this->get('/get-started/add-alicloud-account', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/get-started/add-alicloud-account.php', [
            'title' => 'How to add Alibaba Cloud account to ALM console (EE)'
        ]);

    });

    $this->get('/get-started/add-k5-account', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/get-started/add-k5-account.php', [
            'title' => 'How to add Fujitsu K5 account to ALM console (EE)'
        ]);

    });

    $this->get('/api', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-api.php', [
            'title' => 'API Reference (EE)'
        ]);

    });

    $this->get('/cli', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-cli.php', [
            'title' => 'Use Mobingi command line (EE)'
        ]);

    });

    $this->get('/agent', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/page-agent.php', [
            'title' => 'Use Mobingi ALM agent (EE)'
        ]);

    });



    /**
    * ALM RBAC Routes
    * @path https://learn.mobingi.com/enterprise...
    *
    */

    $this->get('/rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-home.php', [
            'title' => 'Role Based Access Control Documentation'
        ]);

    });

    $this->get('/what-is-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/what-is-rbac.php', [
            'title' => 'What is Role Based Access Control'
        ]);

    });

    $this->get('/rbac-getting-started', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-getting-started.php', [
            'title' => 'Getting Started - Role Based Access Control'
        ]);

    });

    $this->get('/rbac-best-practices', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-best-practices.php', [
            'title' => 'Best Practices - Role Based Access Control'
        ]);

    });

    $this->get('/working-with-rbac', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/working-with-rbac.php', [
            'title' => 'Working with Role Based Access Control'
        ]);

    });

    $this->get('/rbac-reference', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-reference.php', [
            'title' => 'Reference - Role Based Access Control'
        ]);

    });

    $this->get('/rbac-troubleshooting', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-troubleshooting.php', [
            'title' => 'Troubleshooting - Role Based Access Control'
        ]);

    });

    $this->get('/rbac-release-history', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-release-history.php', [
            'title' => 'Release History - Role Based Access Control'
        ]);

    });

    $this->get('/rbac-example-roles', function ($request, $response, $args) {

        return $this->view->render($response, 'enterprise/rbac/rbac-example-roles.php', [
            'title' => 'Example Roles - Role Based Access Control'
        ]);

    });



});
