<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Base {

  public function action_index()
  {
    $this->template->template = 'page';
    $this->template->content = View::factory('pages/'.$this->request->param('page'));
  }

}
