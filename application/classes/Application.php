<?php defined('SYSPATH') or die('No direct script access.');

class Application extends Kohana_URL {

  public static function responsive_image($src, $alt = '', $sources = array())
  {
    $data = array();

    foreach ($sources as $key => $source)
    {
      $data[$key] = self::responsive_image_data($src, $source[0], $source[1]);
      $data[$key.'-retina'] = self::responsive_image_data($src, $source[0] * 2, $source[1] * 2);
    }

    $size = getimagesize(DOCROOT.$src);

    ob_start();
    ?>
    <span class="responsive-image">
      <noscript data-src='<?php echo json_encode($data); ?>'>
        <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
      </noscript>
    </span>
    <?php
    $img = ob_get_contents();
    ob_clean();
    return $img;
  }

  public static function responsive_image_data($path, $width, $height = '', $quality = '85')
  {
    if ($height === '') $height = $width;
    $width = round($width);
    $height = round($height);

    $src = 'picture/w'.$width.'-h'.$height.'-q'.$quality.'-c/'.$path;
    $data = array('src' => $src, 'width' => $width, 'height' => $height);

    return $data;
  }

}
