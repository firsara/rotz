<div class="projects">

  <article class="project">
    <a href="rotz/new">
      <figure>
        <?php echo Application::responsive_image('assets/images/add-new.png', 'add new', array('wide' => array('800', '600'), 'desktop' => array('400', '300'), 'tablet' => array('250', '170'), 'mobile' => array('290', '290'))); ?>
        <div class="overlay">
          <div class="center-outer">
            <div class="center-inner">
              <figcaption>
                <p>Add new</p>
              </figcaption>
            </div>
          </div>
        </div>
      </figure>
      <div class="actions">
        <a class="hate" href="javascript:void();">
          <img src="assets/images/hate.png" alt="Hate">
          <span class="text">0</span>
        </a>
      </div>
    </a>
  </article>

  <?php $projects = ORM::factory('Project')->find_all();
  foreach ($projects as $project): ?>

    <article class="project">
      <a href="rotz/edit/<?php echo $project->id; ?>">
        <figure>
          <?php echo Application::responsive_image($project->image, $project->name, array('wide' => array('800', '600'), 'desktop' => array('400', '300'), 'tablet' => array('250', '170'), 'mobile' => array('290', '290'))); ?>
          <div class="overlay">
            <div class="center-outer">
              <div class="center-inner">
                <figcaption>
                  <p><?php echo $project->name; ?></p>
                </figcaption>
              </div>
            </div>
          </div>
        </figure>
        <div class="actions">
          <a class="hate" href="javascript:void();">
            <img src="assets/images/hate.png" alt="Hate">
            <span class="text"><?php echo $project->hates()->count(); ?></span>
          </a>
        </div>
      </a>
    </article>

  <?php endforeach; ?>

</div>