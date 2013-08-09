<form action="rotz/update/<?php echo $project->id; ?>" method="post" enctype="multipart/form-data">
  <div class="field">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="name" value="<?php echo $project->name; ?>">
  </div>
  <div class="field">
    <label for="url">url</label>
    <input type="text" name="url" placeholder="url" value="<?php echo $project->url; ?>">
  </div>
  <div class="field">
    <?php if (strlen($project->image) > 0): ?>
      <img src="<?php echo $project->image; ?>" alt="<?php echo $project->name; ?>">
    <?php endif; ?>
    <label for="image">image</label>
    <input type="file" name="image">
  </div>
  <div class="field">
    <label for="active">active</label>
    <input type="checkbox" name="active" <?php echo ($project->active == '1' ? 'checked="checked" value="on"' : ''); ?>>
  </div>
  <div class="field">
    <input type="submit" value="<?php echo $project->loaded() ? 'Create rotz' : 'Update'; ?>">
  </div>
</form>