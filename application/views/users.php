<h3><?php echo $title; ?></h3>
<ul class="list-group">
<?php
foreach($users as $user)
{
	echo '<li class="list-group-item">'.$user->name.'</li>';
}
?>
</ul>