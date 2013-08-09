
<div class="projects">

  <article class="project">
    <a href="mailto:rotz@madebyfibb.com?subject=Rotzige Anzeige">
      <figure>
        <?php echo Application::responsive_image('assets/images/white.png', '', array('wide' => array('800', '600'), 'desktop' => array('400', '300'), 'tablet' => array('250', '170'), 'mobile' => array('290', '290'))); ?>
        <div class="overlay visible">
          <div class="center-outer">
            <div class="center-inner">
              <figcaption>
                <p>Hier könnte deine rotzige Anzeige stehen</p>
              </figcaption>
            </div>
          </div>
        </div>
      </figure>
    </a>
  </article>

  <?php foreach ($projects as $project): ?>

    <article class="project">
      <a href="rotz/<?php echo $project->slug; ?>">
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
          <a class="hate" href="rotz/hate/<?php echo $project->id; ?>">
            <img src="assets/images/hate.png" alt="Hate">
            <span class="text"><?php echo $project->hates()->count(); ?></span>
          </a>
          <h6 class="date float-right">vom <?php echo date('d. M Y', strtotime($project->created)); ?></h6>
        </div>
      </a>
    </article>

  <?php endforeach; ?>
  
</div>