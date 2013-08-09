<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Base {

  public function action_index()
  {
    if ( Session::instance()->get('logged_in') )
    {
      $this->template->content = View::factory('admin/edit');
    }
    else
    {
      $this->template->content = View::factory('admin/login');
    }
  }


  public function action_login()
  {
    $username = $this->request->post('username');
    $password = md5($this->request->post('password'));
    $user = ORM::factory('User')->where('username', '=', $username)->and_where('password', '=', $password)->find(1);

    if ( $user->loaded() )
    {
      Session::instance()->set('logged_in', true);
    }

    HTTP::redirect(URL::http_base().'admin');
  }

}
