<?php

/**
 * @file
 * Contains Drupal\configuration_form_example\ConfigurationFormService.
 */

namespace Drupal\configuration_form_example;
use Drupal\Core\Config\ConfigFactoryInterface;

class ConfigurationFormService {
  
  protected $configuration_value;
  protected $configFactory;

  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }
  
  public function getValue() {
    $this->configuration_value = $this->configFactory->getEditable('configuration_form_example.settings');
    return $this->configuration_value; 
  }
  
}