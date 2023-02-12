<?php
namespace Drupal\resume\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Defines dynamic local tasks.
 */
class DynamicLocalTasks extends DeriverBase {

  protected $resumeService;
  
  /**
   * Class constructor.
   */
  public function __construct($resumeService) {
    $this->resumeService = $resumeService;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('resume.local_tasks_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $this->derivatives['resume.tab_1'] = $base_plugin_definition;
    $this->derivatives['resume.tab_1']['title'] = "Resume";
    $this->derivatives['resume.tab_1']['route_name'] = "resume.form";
    $this->derivatives['resume.tab_1']['base_route'] ="resume.form";
    $this->derivatives['resume.tab_2'] = $base_plugin_definition;
    $this->derivatives['resume.tab_2']['title'] = "Work";
    $this->derivatives['resume.tab_2']['route_name'] = "work.form";
    $this->derivatives['resume.tab_2']['base_route'] ="resume.form";
    return parent::getDerivativeDefinitions($base_plugin_definition);
  }

}