<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Projects extends Controller_Base {

  public function before()
  {
    parent::before();

    $action = $this->request->action();

    if (! method_exists($this, $action))
    {
      $project = ORM::factory('Project')->where('slug', '=', $action)->find(1);

      if ($project->loaded())
      {
        $this->show_project_detail($project);
      }
    }
  }

  public function action_index()
  {
    $this->template->template = 'home';
    $this->template->content = View::factory('pages/home');
  }

  public function action_submit()
  {
    $this->template->template = 'rotz_submit';
    $this->template->content = View::factory('projects/submit');
  }

  public function action_thankyou()
  {
    $this->template->template = 'rotz_submit';
    $this->template->content = View::factory('projects/thankyou');
  }

  public function action_post()
  {
    if (strlen($this->request->post('url')) > 0)
    {
      mail('rotz@madebyfibb.com', 'Rotz', $this->request->post('url'));
    }

    HTTP::redirect(URL::http_base().'rotz/thankyou');
  }

  public function action_newest()
  {
    $projects = ORM::factory('Project')->where('active', '=', '1')->order_by('id', 'desc')->find_all();
    $this->template->content = View::factory('projects/index', array('projects' => $projects));
  }

  public function action_hated()
  {
    $projects = ORM::factory('Project')->where('active', '=', '1')->order_by('hateness', 'desc')->find_all();
    $this->template->content = View::factory('projects/index', array('projects' => $projects));
  }

  public function action_worst()
  {
    //$projects = ORM::factory('Project')->where('active', '=', '1')->order_by('hateness', 'desc')->find_all();
    //$this->template->content = View::factory('projects/index', array('projects' => $projects));
  }


  public function action_new()
  {
    if ( Session::instance()->get('logged_in') )
    {
      $this->template->content = View::factory('projects/edit', array('project' => ORM::factory('Project')));
    }
    else
    {
      HTTP::redirect(URL::http_base());
    }
  }

  public function action_edit()
  {
    if ( Session::instance()->get('logged_in') )
    {
      $this->template->content = View::factory('projects/edit', array('project' => ORM::factory('Project', $this->request->param('id'))));
    }
    else
    {
      HTTP::redirect(URL::http_base());
    }
  }

  public function action_update()
  {
    if ( Session::instance()->get('logged_in') )
    {
      $project = ORM::factory('Project');

      $id = $this->request->param('id');

      if (strlen($id) > 0)
      {
        $project = ORM::factory('Project', $id);
      }

      $project->update_data();

      HTTP::redirect('admin');
    }
    else
    {
      HTTP::redirect(URL::http_base());
    }
  }

  public function action_hate()
  {
    $id = $this->request->param('id');

    if (strlen($id) > 0)
    {
      $project = ORM::factory('Project', $id);

      $ipaddress = $_SERVER['REMOTE_ADDR'];
      $hate = ORM::factory('Hate')->where('project_id', '=', $id)->and_where('ip', '=', $ipaddress)->find(1);

      if (! $hate->loaded() )
      {
        $hate->project_id = $id;
        $hate->ip = $ipaddress;
        $hate->save();
      }

      echo $project->hates()->count();
    }
    else
    {
      echo '0';
    }

    die;
  }



  public function show_project_detail($project)
  {
    $this->template->title = 'ROTZPROJEKT: '.strtoupper($project->name);
    $this->template->template = 'project_detail';
    $this->template->content = View::factory('projects/detail', array('project' => $project));
    $this->after();

    echo $this->template->render();
    die;
  }

}
