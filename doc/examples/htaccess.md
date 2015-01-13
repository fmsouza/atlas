Using .htaccess to configure url rewrite in Apache
==================================================

Most of the times, when you are writing PHP systems, you may see that, when you give parameters to the application via ```$_GET```, the URL becomes too huge and ugly. In some kind of systems, it's useful to have it 'human-readable', like in Content Management Systems (CMS) or RESTful services.

If you are writing a RESTful service, for example, probably you'd call your service as

	http://www.host.com/foo/bar

However, it doesn't points the necessary PHP file that loads your application's code. How to solve it? Using .htaccess rewriting rules.

The .htaccess is a file you place in every directory you want to rewrite the access rules. Taking the REST example, we can easily solve the URL issue by writing a .htaccess file with some rules dependent on the Apache's ```mod_rewrite``` and tell it how to understand the path. This file must be placed in the same folder of ```index.php```.

```
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /atlas/
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
 
<IfModule !mod_rewrite.c>
  ErrorDocument 404 /index.php
</IfModule>
```

This configuration tells the following, in order:

* If ```mod_rewrite``` is loaded
	* Turn on the rewrite engine
	* Tells that the system is installed in a directory 'atlas' over the host root
	* Treats the TestString as a pathname and tests whether or not it exists, and is a directory.
	* Treats the TestString as a pathname and tests whether or not it exists, and is a regular file.
	* Says that the rule is: everything you write after the system base path(```^(.*)$```), will be after the ```index.php/```

* If ```mod_rewrite``` isn't loaded
	* Makes an ```404``` request to index.php