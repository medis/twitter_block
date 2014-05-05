<?php

/**
 * @file
 * Contains \Drupal\twitter_block\Plugin\Field\FieldType\twitterSettingItem.
 */

 namespace Drupal\twitter_block\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\TypedData\MapDataDefinition;

/**
 * Plugin implementation of the 'twitterSettingItem' field type.
 *
 * @FieldType(
 *   id = "twitter_setting",
 *   label = @Translation("Twitter Setting"),
 *   description = @Translation("Twitter Setting"),
 *   default_widget = "twitter_setting_default",
 *   default_formatter = "twitter_setting"
 * )
 */
class twitterSettingItem extends FieldItemBase {
    
   /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldDefinitionInterface $field_definition) {
    $properties['cotent_type'] = DataDefinition::create('string')
      ->setLabel(t('Content Type'));

    $properties['field'] = DataDefinition::create('string')
      ->setLabel(t('Field'));

    return $properties;
  }
  
  /*public static function getDataDefinition() {
      var_dump($this->definition);die('aa');
      return 'aa';
      return $this->definition;
  }*/
  
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'content_type' => array(
          'type' => 'varchar',
          'length' => 256,
          'not null' => TRUE,
        ),
        'field' => array(
          'type' => 'varchar',
          'length' => 256,
          'not null' => TRUE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('field')->getValue();
    return $value === NULL || $value === '';
  }

  
  /**
   * {@inheritdoc}
   */
  /*public function getPropertyDefinitions() {
    if (!isset(static::$propertyDefinitions)) {
      static::$propertyDefinitions['content_type'] = array(
        'type' => 'string',
        'label' => t('HEX Color value'),
      );
      static::$propertyDefinitions['field'] = array(
        'type' => 'float',
        'label' => t('Alfa value'),
      );
    }
    return static::$propertyDefinitions;
  }*/
  

}
