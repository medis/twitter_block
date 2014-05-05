<?php

use Drupal\Core\Config\ConfigFactory;
use Drupal\node\NodeInterface;

/**
 * @file
 * Contains \Drupal\twitter_block\Plugin\Block\TwitterBlock.
 */

namespace Drupal\twitter_block\Plugin\Block;

use Drupal\block\BlockBase;

/**
 * Provides a 'Twitter Block'.
 * 
 * @Block(
 *   id = "twitter_block",
 *   admin_label = @Translation("Twitter Block")
 * )
 */
class TwitterBlock extends BlockBase {
  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {
    $node = \Drupal::request()->attributes->get('node');

    if (!$node || 'company' != $node->getType())
      return '';
    
    // Load 3rd party library.
    $library = libraries_get_path('twitter-api-php');
    if (empty($library))
      return;

    require_once sprintf(DRUPAL_ROOT . '/%s/TwitterAPIExchange.php', $library);
    
    $config = config('twitter.settings');
    $template = $config->get('template');
    $template = preg_replace('/.html.twig/', '', $template);
    
    $twitter_un = $node->get('field_twitter')->value;
    
    $tweets = $this->get_tweets($twitter_un, $config);
    $this->process_tweets_data($tweets);
    $additional = $this->get_additional($twitter_un, $tweets);
    

    $return_array = array(
      '#theme' => $template . '_block',
      '#username' => $additional['username'],
      '#tweets' => $tweets,
    );
    
    $asset = $this->get_asset($template, 'css');
    if ($asset != FALSE) {
      $return_array['#attached']['css'] = array($asset);
    }
    
    $asset = $this->get_asset($template, 'js');
    if ($asset != FALSE) {
      $return_array['#attached']['js'] = array($asset);
    }

    return $return_array;
  }
  
  /*
  * Get Twitter settings.
  */
  function get_settings($config) {
    return array(
      'oauth_access_token' => $config->get('twitter_oauth_access_token'),
      'oauth_access_token_secret' => $config->get('twitter_oauth_access_token_secret'),
      'consumer_key' => $config->get('twitter_consumer_key'),
      'consumer_secret' => $config->get('twitter_consumer_secret')
    );
  }
  
  /**
   * Get asset.
   */
  function get_asset($template, $type) {
    $path = format_string("@path/templates/@template/@template.@type", array(
      '@path' => drupal_get_path('module', 'twitter_block'),
      '@template' => $template,
      '@type' => $type,
    ));

    if (!file_exists(DRUPAL_ROOT . '/' . $path)) {
      return FALSE;
    }
    
    return $path;
  }
  
  /**
  * Get RAW tweets.
  * @param type $username - Twitter account name
  * @return array of tweets
  */
  function get_tweets($username, $config) {
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = format_string('?screen_name=@s', array('@s' => $username));
    $requestMethod = 'GET';

    $settings = $this->get_settings($config);
    $twitter = new \TwitterAPIExchange($settings);

    $response = $twitter->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest();

    return json_decode($response);
  }
  
  function process_tweets_data(&$data) {
    foreach ($data as &$tweet) {
      $tweet->time_ago = $this->time_ago(strtotime($tweet->created_at));
      $this->format_tweet($tweet->text);
      if (isset($tweet->retweeted_status) && !empty($tweet->retweeted_status)) {
       $this->format_tweet($tweet->retweeted_status->text);
      }
    }
  }

  function get_additional($twitter_un, $raw_tweets) {
    return array(
      'username' => $twitter_un,
    );
  }
  
  function format_tweet(&$text) {    
    $text = preg_replace(
      '/(https?:\/\/\S+)/',
      '<a href="\1" target="_blank">\1</a>',
      $text
	);
	
	// linkify user links
	$text = preg_replace(
	  '/(^|\s)@(\w+)/',
	  '\1<a href="https://twitter.com/\2" target="_blank">@\2</a>',
	  $text
	);
	// linkify hashtags
	$text = preg_replace(
	  '/(^|\s)#(\w+)/',
	  '\1<a href="https://twitter.com/search?q=%23\2&src=hash" target="_blank">#\2</a>',
	  $text
	);
  }
  
  function time_ago($tm, $rcs = 0) {
    $cur_tm = time(); 
    $dif = $cur_tm - $tm;
    $pds = array('s','m','h','day','week','month','year','decade');
    $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);

    for ($v = count($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--);
      if ($v < 0)
        $v = 0;
    $_tm = $cur_tm - ($dif % $lngh[$v]);

    $no = ($rcs ? floor($no) : round($no)); // if last denomination, round
    $x = $no . $pds[$v];

    if (($rcs > 0) && ($v >= 1))
      $x .= ' ' . $this->time_ago($_tm, $rcs - 1);

    if (preg_match('/day|days|week|weeks|month|months|year|years/', $x))
      $x = date('j M', strtotime('-' . $x));

    return $x;
  }
}