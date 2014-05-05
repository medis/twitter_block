<?php

/**
 * @file
 * Contains \Drupal\twitter_block\Plugin\Field\FieldFormatter\twitterSettingFormatter.
 */

 namespace Drupal\twitter_block\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Component\Utility\String;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FormatterBase;

 /**
 * Plugin implementation of the 'twitterSetting_default_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "twitter_setting",
 *   label = @Translation("Twitter Setting default"),
 *   field_types = {
 *     "twitter_setting"
 *   }
 * )
 */

class twitterSettingFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = array();

    $element[] = array(
        '#markup' => '<p>aa</p>',
      );
    
    return $element;
  }
}
