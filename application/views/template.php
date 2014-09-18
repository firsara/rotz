<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <title><?php echo $title; ?></title>
  <base data-state="<?php echo URL::base(); ?>" href="<?php echo URL::http_base(); ?>">

  <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" href="assets/stylesheets/screen.css">
  <link rel="stylesheet" href="assets/stylesheets/icons.css">

  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

  <meta property="og:image" content="assets/images/logo_og.png">
  <meta property="og:title" content="<?php echo $title; ?>">
  <meta property="og:url" content="<?php echo Request::current()->uri(); ?>">

</head>
<body class="template-<?php echo $template; ?>">

  <header id="header">
    <div class="container-fluid clearfix">
      <a class="home" href="<?php echo URL::http_base(); ?>">
        <img src="assets/images/hate-white.png" alt="Rotzprojekt">
        <span class="text">
          <h1>ROTZPROJEKT</h1>
          <h2>FOR YOUR DAILY AMUSEMENT</h2>
        </SPAN>
      </a>
      <nav id="nav">
        <ul>
          <li>
            <a href="rotz/newest"<?php echo (Request::current()->action() === 'newest' ? ' class="active"' : ''); ?>>
              Aktuellster Rotz
            </a>
          </li>
          <li>
            <a href="rotz/hated"<?php echo (Request::current()->action() === 'hated' ? ' class="active"' : ''); ?>>
              Am rotzigsten
            </a>
          </li>
          <li>
            <a href="rotz/worst"<?php echo (Request::current()->action() === 'worst' ? ' class="active"' : ''); ?>>
              Rotz des monats
            </a>
          </li>
          <li>
            <a href="rotz/submit"<?php echo (Request::current()->action() === 'submit' ? ' class="active"' : ''); ?>>
              Rotz einreichen
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>


  <?php if ($template === 'project_detail'): ?>

    <?php echo $content; ?>

  <?php else: ?>

    <section id="content">
      <div id="content-inner" class="container-fluid">
        <?php echo $content; ?>
      </div>
    </section>

  <?php endif; ?>


  <footer id="footer">
    <div class="container-fluid clearfix">
      <h3 class="float-left"><a href="http://madebyfibb.com" target="_blank">ROTZ is a timekiller project madebyfibb</a></h3>
      <h3 class="float-right"><a href="impressum">Impressum</a>
    </div>
  </footer>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/javascripts/vendor/jquery.min.js"><\/script>');</script>

  <?php if (Kohana::$environment === Kohana::DEVELOPMENT): ?>

  <?php
  $contents = file_get_contents('assets/javascripts/app.js');
  $tmp = explode('@codekit-prepend', $contents);

  foreach ($tmp as $val)
  {
    if (strpos($val, 'partials/closure.') !== false) continue;

    if (strpos($val, '"') !== false)
    {
      $val = substr($val, strpos($val, '"') + 1);
      $val = substr($val, 0, strpos($val, '"'));
      $path = str_replace(DOCROOT, '', realpath('assets/javascripts/'.$val));
      //$path = trim($val);
      echo '<script src="'.$path.'"></script>'."\n";
    }
  }
  ?>

  <?php else: ?>

  <script src="assets/javascripts/app.min.js"></script>

  <?php endif; ?>

<?php if (Kohana::$environment === Kohana::PRODUCTION): ?>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-40733628-3', 'rotz.madebyfibb.com');
ga('send', 'pageview');
</script>

<?php endif; ?>

</body>
</html>