<?php

namespace Drupal\custom_field_type\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "custom field type".
 * 
 * @FieldType(
 *   id = "baz",
 *   label = @Translation("Baz field"),

 *   description = @Translation("Desc for Baz field"),
 *   category = @Translation("Text"),
 * )
 */

class CustomFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */

  public static function schema(FieldStorageDefinitionInterface $field_definition) {
  	return [
  		'columns' => [
  			'value' => [
  				'type' => 'text',
  				'size' => 'tiny',
  			],
  		],
  	];
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
  	return [
  		'size' => 'large',
  	] + parent::defaultFieldSettings();
  }
  
  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
  	$element = [];
  	$element['size'] = [
  		'#type' => 'select',
  		'#title' => 'size',
  		'#options' => [
  			'small' => $this->t('Small'),
  			'medium' => $this->t('Medium'),
  			'large' => $this->t('Large'),
  		],
  		'#required' => TRUE,
      '#default_value' => $this->getSetting('size'),
  	];
  	return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
  	$properties['value'] = DataDefinition::create('string')->setLabel(t("XYZ"));

  	return $properties;
  }
}