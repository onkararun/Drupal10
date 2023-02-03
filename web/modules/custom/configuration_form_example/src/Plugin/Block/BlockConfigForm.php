<?php

namespace Drupal\configuration_form_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block that has custom configuration option.
 *
 * @Block(
 *   id = "block_config_form",
 *   admin_label = @Translation("Block with custom service: configuration form"),
 *   category = "Examples"
 * )
 */
class BlockConfigForm extends BlockBase implements ContainerFactoryPluginInterface {

    /**
   * Drupal\Core\Form\FormBuilderInterface definition.
   *
   * @var formBuilder
   */
  protected $formBuilder;

  /**
   * Constructs a new ManagingActivitiesRegisterBlock object.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   */
  public function __construct(array $configuration,
                              $plugin_id,
                              $plugin_definition,
                              FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
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
      $container->get('form_builder')
    );
  }

  /**
   * @inheritDoc
   */
  public function build() {
    $toggle_me = $this->getConfiguration()['toggle_me'];
    $form = $this->formBuilder->getForm('Drupal\configuration_form_example\Form\SettingsForm');
    if($toggle_me == TRUE){
      return $form;
    }
  }

    /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) : array {
    $form = parent::blockForm($form, $form_state);

    // Retrieve the blocks configuration as the values provided in the form
    // are stored there.
    $config = $this->getConfiguration();

    // The form field is defined and added to the form array here.
    $form['toggle_me'] = array(
      '#type' => 'checkbox',
      '#title' => t('Click'),
      '#default_value' => $config['toggle_me'] ?? '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) : void {
    
  }

  /**
   *
   */
  public function blockSubmit($form, FormStateInterface $form_state) : void {
    // We do this to ensure no other configuration options get lost.
    parent::blockSubmit($form, $form_state);

    // Here the value entered by the user is saved into the configuration.
    $this->configuration['toggle_me'] = $form_state->getValue('toggle_me');
  }
}
