<div class="row-fluid">
  Latest Post:
<?php
  foreach ($posts as $post)
  {
    echo '<div class="span12">';
    echo '<h3>'.$post->title.'<h3>';
    echo '<p>'.$post->post.'</p>';
  }
?>
</div>
