<div class="row-fluid">
<?php
  //Displays a list of all posts, categorized by date
  $current_date = NULL;
  foreach ($posts as $post)
  {
    if ($current_date != date('d-m-Y', strtotime($post->created_on)))
    {
      $current_date = date('d-m-Y', strtotime($post->created_on));
      echo $current_date."<br><hr>";

    }
    echo '<div class="span12">';
    echo '<h3>'.$post->title.'<h3>';
    echo '<p>'.$post->post.'</p>';
    echo '<span><button data-post-id="'.$post->id.'" class="viewPost btn">View comments</button></span>';
    if ($post->user_id == Auth::instance()->get_user()->id)
    {
      echo '<span><button data-post-id="'.$post->id.'" class="deletePost btn">Delete Post</button></span>';
    }
    echo '</div>';
  }
?>
</div>
