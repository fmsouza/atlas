Creating and Loading Classes
============================

When you are dealing with objects from the zero in PHP, you may encounter problems when you want to load the classes. Your ```.php``` file doesn't knows anything about the things you want to use unless you describe or load'em in the file. But the code doesn't gets well clean if you have to do a ```require('path/to/class.php')``` for every class you wanna use in every file. Tha's why Marvie uses the autoload built-in function to help you.

There are only a few rules you must follow to let Atlas easily take care of this problem for you.

1. The file and the class name must be the same, with case sensitivity. It means that if your class name is ```MyClass```, the file containing this class must be called ```MyClass.php```.

2. The class must has a ```namespace``` defined before it's definition. This namespace must be the path from the project root to the directory where the class may be found, exchanging the '/' for '\' and excluding the class name. It means that if your class is located in ```application/src/path/to/MyClass.php```, the namespace must be defined like

	```php
	<?php

	namespace application\src\path\to;

	class MyClass{
		...
	}
	```

3. If you want to load another class to your file, you may do it in two ways (Example: loading ```path/to/OtherClass.php``` in my class):
	* Use it directly using the full path to it as defined in the namespace.
	```php
	<?php

	namespace application\src\path\to;

	class MyClass{
		...
		public function method(){
			$obj = new \path\to\OtherClass();
		}
		...
	}
	```

	* or you may ```use``` it first and then do what you want.
	```php
	<?php

	namespace application\src\path\to;

	use path\to\OtherClass;

	class MyClass{
		...
		public function method(){
			$obj = new OtherClass();
		}
		...
	}
	```

Note: you can even define aliases for the loaded class names, what can be of utility when you are loading two classes with the same name. You can just import one of them by doing ```use path\to\Foo as Bar;``` and you'll use it in this class as ```Bar```.

Note: Some modern IDEs also helps you dealing with namespaces. The JetBrains PhpStorm (https://www.jetbrains.com/phpstorm/), for example, adds an 'use' line with the class path for every class you select through the auto-complete.

Note: PHP Namespaces reference - http://php.net/manual/pt_BR/language.namespaces.php