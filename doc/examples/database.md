Creating a database connection
==============================

Warning: this feature is still under huge development and may have changes in the next updates.

The use of databases is one of the most difunded practices across the developer community when emerges a necessity to persist data. Databases are useful for store this data in a secure way. Each language has it's own way to connect to databases, and it's not different with PHP. What Atlas does about it is encapsulate and create a pattern to connect to databases, so you can write your code once and avoid much difficulty if you need to change your database driver someday.

Configuring the environment
---------------------------

To connect to a database in Atlas, you must fill the data in the ```config.json``` which corresponds to database.

```php
{
	...

	"database": {
		"host": 		"",
		"user": 		"",
		"password": 	"",
		"dbName": 		"",
		"tblPrefix": 	"",
		"charset": 		"",
		"driver": 		""
	},
}
```

This data corresponds to a nested json with all the configuration the database may need to create an instance.

* __Host__: your server address (eg. ```localhost``` or ```db.mypath.com```)
* __user__: the username with permissions to do operations in the database
* __password_: the user password
* __dbName__: the database name to be connected in the server
* __tblPrefix__: if your tables use a prefix, you should specify here
* __charset__: the character encoding used in the database
* __driver__: Database Driver to be used to connect to the server

Note: Currently, Atlas only support ```Mysql``` driver.

Connecting and using
--------------------

With the environment set, all you have to do is ask for an instance of database and do your queries.

```php
Database::$connInf = System::getConfig()->database; // configures the database
$db = Database::getInstance(); // gets the correct database driver instance
$result = $db->query("SELECT foo, bar FROM 'tablename'"); // returns a DatabaseResult instance with the data
```

And then you can iterate over the data matrix

```php
for($i=0; $i < $result->getNumRows(); $i++){
	$result->seek($i); // walk over one line in the buffer
	$res = $result->getRow(); // gets the line data
	echo("Foo: ".$res->foo);
	echo("\nBar: ".$res->bar);
}
```

Note: [Reference - Atlas API](../../api/packages/core.control.database.html)