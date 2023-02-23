<?php

namespace Drupal\custom_permission;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class DynamicPermissions
 * @package Drupal\mymodule
 */
class DynamicPermissions
{

  use StringTranslationTrait;

  /**
   * @return array
   */
  public function permissions()
  {
    $permissions = [];

    
    for($count = 1; $count <= 5; $count++) {
      $permissions += [
        "mymodule permission $count" => [
          'title' => $this->t('mymodule permission @number', ['@number' => $count]),
          'description' => $this->t('This is a sample permission generated dynamically.'),
          'restrict access' => $count == 2 ? true : false,
        ],
      ];
    }
    return $permissions;
  }

}