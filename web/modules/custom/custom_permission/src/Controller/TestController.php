<?php
namespace Drupal\custom_permission\Controller;

use Drupal\Core\Controller\ControllerBase;

class TestController extends ControllerBase {
    public function getTest() {
        if (\Drupal::currentUser()->hasPermission('static permission 1')) {
            echo 'The "sample permission 1" has been granted to the current user';
        }
        else {
            echo 'The "sample permission 1" has NOT been granted to the current user';
        }
    }
}