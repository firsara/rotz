<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {

  public function before()
  {
    parent::before();

    $this->template->title = 'ROTZPROJEKT | FOR YOUR DAILY AMUSEMENT';
    $this->template->template = 'default';
    $this->template->content = '';
  }

	public function action_index()
	{
	}

}
