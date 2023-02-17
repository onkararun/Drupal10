<?php

namespace Drupal\custom_hook\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides block for showing latest hacks of drupalhacks.
 *
 * @Block(
 *   id = "block_custom_hook",
 *   admin_label = @Translation("Block with custom hook: LatestHacks"),
 * )
 */
class BlockCustomHook extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface;
   */
  protected $moduleHandler;

  /**
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   */
  public function __construct(array $configuration,
                              $plugin_id,
                              $plugin_definition,
                              ModuleHandlerInterface $module_handler) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleHandler = $module_handler;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @return ManagingActivitiesRegisterBlock
   */
  public static function create(ContainerInterface $container,
                                array $configuration,
                                $plugin_id,
                                $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('module_handler')
    );
  }

  /**
   * @inheritDoc
   */
  public function build() {
    $hacks_tid = 1;
    $query = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('field_latest_hacks', $hacks_tid)
      ->sort('created', 'DESC')
      ->range(0,5);
    $list = $query->execute();
    // for hook call
    $this->moduleHandler->invokeAll('drupalhacks_latest_hacks', [$list]);
    // for alter hook
    //$this->moduleHandler->alter('drupalhacks_latest_hacks', $list);

    $list_to_string = implode(",", $list);
    return [
      '#markup' => '<marquee>Latest Hacks: ' . $list_to_string . '</marquee>',
      '#allowed_tags' => ['marquee'],
    ];
  }
}
