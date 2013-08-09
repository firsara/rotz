<div class="center">
  <h1><span class="uppercase">Rotzprojekt.com</span> <br>
    <small>Für die tollen Kehrseiten des Webs</small></h1>

  <p>Hier findest du die Seiten, die sonst auf keiner anderen CSS-Gallery Platz finden.</p>
  <p>Uns gibt's auch auf Facebook: <a href="http://facebook.com/rotzprojekt" target="_blank">facebook.com/rotzprojekt</a>, den Rotz braucht's heute einfach!</p>
</div>


<?php 
$projects = ORM::factory('Project')->where('active', '=', '1')->order_by('id', 'desc')->find_all();
echo View::factory('projects/index', array('projects' => $projects))->render();
?>