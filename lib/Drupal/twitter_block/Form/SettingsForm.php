<?php

namespace Drupal\twitter_block\Form;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Form\ConfigFormBase;

class SettingsForm extends ConfigFormBase {
  public function __constructt(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }
  public function getFormId() {
    return 'twitter.settings_form';
  }
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('twitter.settings');

    $form['twitter_oauth_access_token'] = array(
      '#type' => 'textfield',
      '#title' => t('Oauth Access Token'),
      '#required' => TRUE,
      '#default_value' => $config->get('twitter_oauth_access_token'),
    );
    $form['twitter_oauth_access_token_secret'] = array(
      '#type' => 'textfield',
      '#title' => t('Oauth Access Token Secret'),
      '#required' => TRUE,
      '#default_value' => $config->get('twitter_oauth_access_token_secret'),
    );
    $form['twitter_consumer_key'] = array(
      '#type' => 'textfield',
      '#title' => t('Consumer Key'),
      '#required' => TRUE,
      '#default_value' => $config->get('twitter_consumer_key'),
    );
    $form['twitter_consumer_secret'] = array(
      '#type' => 'textfield',
      '#title' => t('Consumer Secret'),
      '#required' => TRUE,
      '#default_value' => $config->get('twitter_consumer_secret'),
    );

    return parent::buildForm($form, $form_state);
  }
  public function submitForm(array &$form, array &$form_state) {
    // Save submitted values.
    $this->configFactory->get('twitter.settings')
         ->set('twitter_oauth_access_token', $form_state['values']['twitter_oauth_access_token'])
         ->set('twitter_oauth_access_token_secret', $form_state['values']['twitter_oauth_access_token_secret'])
         ->set('twitter_consumer_key', $form_state['values']['twitter_consumer_key'])
         ->set('twitter_consumer_secret', $form_state['values']['twitter_consumer_secret'])
         ->save();

    parent::submitForm($form, $form_state);
  }

}
