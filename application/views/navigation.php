<div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav">
          <li <?php echo ($active == 'login') ? "class='active'" : ""; ?>><a href="/blog/login">Login</a></li>
          <li <?php echo ($active == 'readers') ? "class='active'" : ""; ?>><a href="/blog/readers">Readers</a></li>
          <li <?php echo ($active == 'authors') ? "class='active'" : ""; ?>><a href="/blog/authors">Authors</a></li>
          <li <?php echo ($active == 'posts') ? "class='active'" : ""; ?>><a href="/blog/posts">Blog Posts</a></li>
          <li <?php echo ($active == 'new') ? "class='active'" : ""; ?>><a href="/blog/new">New Post</a></li>
        </ul>
    </div>
  </div><!-- /.navbar -->
</div>