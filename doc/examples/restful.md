Creating a RESTful service
==========================

Marvie turns creating a webservice so simple that you almost won't have to write code.

Firstly, you have to load the ```RESTful``` class in your application by loading it's ```namespace``` in the file's import section and instantiate the class to call the service.

```php
// ...
use core\control\tools\rest\RESTful;

class App{

	// ...

	public static function main(){
		$rest = new RESTful();
		$rest->serve();
		echo($rest->getResponse());
	}

	// ...
}
```

This code does:

* Loads the RESTful class to the application and instantiates
* Deals with the request did by the client
* Prints it's return to the screen

Great. We have a REST service up and running! But how to say how will I deal with each request? You must tell it in the config.json file, commonly located in ```application/environment/config.json``` by indicating the classes in the ```resources``` parameter. For this example, we'll only create a class called ```TestResource``` which will be located in ```application/src/resources``. The file will be like

```json

{
	// ...

	"resources": [
		"application.src.resources.TesteResource"
	],

	// ...
}

```

Note: you must ever write the keys and the values in the JSON file between quotes ("...") off if the value is numeric, in this case the value must be written directly.

Now the system knows that it'll serve a REST service and the class that will manage it's requests can be found in the file ```application/src/resources/TesteResource.php```. Now you only have to write the class.

The class must extend the ```Resource``` class, which gives it some resources to help the service to do it's job, otherwise an ```Exception``` will be launched.

The handler methods are idetified by ```Annotations``` like
```php
@route(path: 'path/to/service', method: 'GET');
```
inside the Documentation Block  of the method.

Source code:

```php
namespace application\src\resources;

use core\control\tools\rest\Resource;

class TestResource extends Resource{
    
    /**
    * @route(path: 'path/to/service', method: 'GET');
    */
    public function getMethod($data){
        return $this->success('Hello World!');
    }
}
```
Note: the annotation line must begin with a '@' and end with a ';'.

This code tells that, when the url ```http://www.web-host.com/index.php/path/to/service``` is accessed through a ```GET``` request, ```TestResource::getMethod``` is called and executes all it's routine. In that case, the routine only return a ```JSON``` success string with the message "Hello World!".

```json
{"type": "success", "message": "Hello World!"}
```

Note: the routed methods must always return the output value.