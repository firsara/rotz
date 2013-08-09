<?php defined('SYSPATH') or die('No direct script access.');

// Rotz of the month

class Model_Project extends ORM {


  public function __construct($id = NULL)
  {
    parent::__construct($id);
    
    $this->calculate_hateness();
  }

  public function find($id = NULL)
  {
    $result = parent::find($id);
    
    $this->calculate_hateness();

    return $result;
  }

  public function calculate_hateness()
  {
    if ($this->loaded())
    {
      $age = time() - strtotime($this->created);
      $age_hours = $age / Date::HOUR;

      // picture only gets hot after 4 hours
      //if ($age_hours > 4)
      if (true)
      {
        $age_days = $age / Date::DAY;

        $hate_count = $this->hates()->count();

        $hateness = pow($hate_count, 2);
        $hateness = $hateness / $age_days;
        $hateness = sqrt($hateness);
        $hateness = round($hateness);

        $this->hateness = $hateness;
        $this->save();
      }
    }
  }




  public function hates()
  {
    return ORM::factory('Hate')->where('project_id', '=', $this->id)->find_all();
  }


  public function update_data()
  {
    $this->values(Request::current()->post());

    if (Request::current()->post('active') == 'on')
      $this->active = '1';
    else
      $this->active = '0';

    if (strlen($this->name) === 0) return $this;
    if (strlen($this->url) === 0) return $this;

    $this->slug = self::unique_slug($this->name);

    $file = @$_FILES['image'];

    if (isset($file) && count($file) > 0 && isset($file['name']) && strlen($file['name']) > 0)
    {
      $name = md5(uniqid().time()).'.'.strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $directory = DOCROOT.'data/projects';
      $tmp_path = Upload::save($file, $name, $directory);

      $image = Image::factory($tmp_path);

      if ($image->width > 1200)
      {
        $image->resize(1200, NULL);
        $image->save();
      }

      $this->image = str_replace(DOCROOT, '', $tmp_path);
    }
    else
    {
      if (strlen($this->image) === 0)
      {
        return $this;
      }
    }

    $this->save();

    return $this;
  }


  private static function unique_slug($url, $allow = NULL)
  {
    $url = self::safe_url($url);

    if ($url === $allow)
    {
      return $url;
    }


    $increment = 0;
    $tmp_url = $url;

    while (ORM::factory('Project')->where('slug', '=', $tmp_url)->find(1)->loaded() !== false)
    {
      $increment++;
      $tmp_url = $url.'-'.$increment;

      if ($tmp_url === $allow)
      {
        break;
      }
    }

    $url = $tmp_url;

    return $url;
  }


  public static function safe_url($str)
  {
    $str = strtolower($str);
    $str = str_replace(' ', '-', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('ä', 'ae', $str);
    $str = str_replace('ö', 'oe', $str);
    $str = str_replace('ü', 'ue', $str);
    $str = str_replace('ß', 'ss', $str);
    $str = str_replace('&', '-', $str);
    $str = str_replace('--', '-', $str);
    $str = str_replace('--', '-', $str);
    $str = str_replace('--', '-', $str);

    $str = strip_tags($str);
    $str = urlencode($str);

    return $str;
  }

}
