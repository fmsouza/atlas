Creating functions
==================

As Marvie offers you an Object-oriented environment, the classic function doesn't fits here exactly how it used to be. To create a function, you must declare it as a static method of a class.

Example: creating a function ```encodeBase64```, which receives a string as parameter and returns the encoded string, inside the class found in```application/src/Utilities.php```

```php
	<?php

	namespace application\src;

	class Utilities{
		...
		public static function encodeBase64($data){
			return base64_encode($data);
		}
		...
	}
```

You may, then, use it by calling ```Utilities::encodeBase64($data)``` in your context.

Note: See [Class loading](classes.md)

Note: See [PHP - Static Keyword](http://php.net/manual/en/language.oop5.static.php)