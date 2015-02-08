# Installation Step

1.  This project requires the Kohana PHP Framework. It assumes that this repository is cloned to a folder that is configured to be the DocumentRoot in an Apache Virtual host configuration. Ie: c:\wamp\blog\application would be the application folder in the repo.
    
```
<VirtualHost *:80>
    DocumentRoot "c:\wamp\blog"
    ServerName localhost
</VirtualHost>
    
```

2.  Update the application/config/database.php to the proper connection parameters:
```
'connection' => array(
	'hostname' => 'localhost',
	'database' => 'blog',
	'username' => 'root',
	'password' => '',
	'persistent' => FALSE,
)
```

3. Run the database creation on the database setup in step 2 using the script which is found in
### database.sql

# NOTES

- The first 5 commits are setup for the Kohana framework itself and are NOT my work(except the configuration files)
- I did not get a chance to add unit testing. If this is a mandatory requirement, some could be added, but I won't have a chance because of other commitments for a few days.
- Bootstrap is used for CSS. CSS was only as advanced as needed to be intuitive enough for the user to use.
- RequireJS would have been used mainly for the "comment.js" files. But it seemed like overkill for this exercise. See comments in this file for more info: /assets/js/comment.js
- Default users created are reader1, reader2, reader3,reader4,author1,author2,author3,author4. USE THESE TO LOGIN
- Some of the components(textareas used for blogs/post) used would be replaced by better components in a complete UI framework or by better components available(such as TinyMCE) but for this exercise it was overkill.

# Info about Kohana PHP Framework

[Kohana](http://kohanaframework.org/) is an elegant, open source, and object oriented HMVC framework built using PHP5, by a team of volunteers. It aims to be swift, secure, and small.

For further possible issues with Kohana installation, please visit:
http://kohanaframework.org/3.3/guide/kohana/install

### If there are problems installing or other questions, please contact me. 