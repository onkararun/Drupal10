<?php
namespace Drupal\resume\Plugin\Derivative;
use Drupal\resume\LocalTasksService;
use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Defines dynamic local tasks.
 */
class DynamicLocalTasks extends DeriverBase implements ContainerDeriverInterface {

  protected $resumeService;
  
  /**
   * Class constructor.
   */
  public function __construct(LocalTasksService $resumeService) {
    $this->resumeService = $resumeService;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
    return new static(
      $container->get('resume.local_tasks_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $data = $this->resumeService->getData();
    foreach ($data as $key => $value) {
      $tab_name = $value['tab_name'];
      $route_name = $value['route_name'];
      $title = $value['title'];
      $base_route = $value['base_route'];
      if($base_route){
        $this->derivatives[$tab_name] = $base_plugin_definition;
        $this->derivatives[$tab_name]['title'] = $title;
        $this->derivatives[$tab_name]['route_name'] = $route_name;
        $this->derivatives[$tab_name]['base_route'] = $base_route;
      }

    }
    return parent::getDerivativeDefinitions($base_plugin_definition);
  }
}