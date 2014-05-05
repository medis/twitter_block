<?php

namespace Drupal\twitter_block\Form;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Form\ConfigFormBase;

class TemplateForm extends ConfigFormBase {
  public function __constructt(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }
  public function getFormId() {
    return 'twitter.template_form';
  }
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('twitter.settings');

    $form['template'] = array(
      '#type' => 'select',
      '#title' => t('Template'),
      '#required' => TRUE,
      '#options' => twitter_block_scanTemplates(),
      '#default_value' => $config->get('template')
    );

    return parent::buildForm($form, $form_state);
  }
  public function submitForm(array &$form, array &$form_state) {
    // Save submitted values.
    $this->configFactory->get('twitter.settings')
         ->set('template', $form_state['values']['template'])
         ->save();

    parent::submitForm($form, $form_state);
  }

}
