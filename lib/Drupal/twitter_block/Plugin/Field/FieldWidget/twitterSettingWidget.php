<?php

/**
 * @file
 * Contains \Drupal\twitter_block\Plugin\Field\FieldWidget\twitterSettingWidget.
 */

namespace Drupal\twitter_block\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;

/**
 * Plugin implementation of the 'twitterSetting_default_widget' widget.
 *
 * @FieldWidget(
 *   id = "twitter_setting_default",
 *   label = @Translation("Twitter setting widget"),
 *   field_types = {
 *      "twitter_setting",
 *   }
 * )
 */

class twitterSettingWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, array &$form_state) {
    $element['content_type'] = array(
      '#type' => 'textfield',
      '#title' => t('Content Type'),
      '#placeholder' => 'Content Type',
      '#default_value' => isset($items[$delta]->content_type) ? $items[$delta]->content_type : NULL,
      '#maxlength' => 2048,
    );
    $element['field'] = array(
      '#type' => 'textfield',
      '#title' => t('Field'),
      '#placeholder' => 'Field',
      '#default_value' => isset($items[$delta]->field) ? $items[$delta]->field : NULL,
      '#maxlength' => 255,
    );

    // If cardinality is 1, ensure a label is output for the field by wrapping it
    // in a details element.
    if ($this->fieldDefinition->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
      );
    }

    return $element;
  }
  
  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    return $summary;
  }
}
