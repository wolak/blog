<div class="row-fluid">
<?php
  /*Displays a list of all posts, categorized by date. This could be separated more from the data in a live app. */
  $current_date = NULL;
  foreach ($posts as $post)
  {
    if ($current_date != date('d-m-Y', strtotime($post->created_on)))
    {
      $current_date = date('d-m-Y', strtotime($post->created_on));
      echo $current_date."<br><hr>";

    }
    echo '<div class="span12 blogItem">';
    echo '<h3>'.$post->title.'</h3>';
    echo '<div class="postContent">'.$post->post.'</div>';
    echo '<button data-post-id="'.$post->id.'" class="viewComments btn">View comments</button>';
    if ($post->user_id == Auth::instance()->get_user()->id)
    {
      echo '<button data-post-id="'.$post->id.'" class="deletePost btn">Delete Post</button>';
      echo '<button data-post-id="'.$post->id.'" class="updatePost btn">Update Post</button>';
    }
    echo '<div class="commentContainer">';
    echo '</div></div>';
  }
?>
</div>
