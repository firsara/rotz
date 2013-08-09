<?php defined('SYSPATH') or die('No direct script access.');

class URL extends Kohana_URL {

  public static $is_profile_page = false;

  public static function http_base()
  {
    return 'http://'.$_SERVER['HTTP_HOST'].URL::base();
  }



  public static function is_newest()
  {
    //return Request::current()->uri() === 'new';
    return Request::current()->uri() === '';
  }

  public static function is_hottest()
  {
    return Request::current()->uri() === 'hot';
  }

  public static function is_network()
  {
    return Request::current()->uri() === 'network';
  }

}
