Creating custom annotations
===========================

Warning: this feature still under heavy development.

Annotations are a very useful tools commonly used in most, if not all, of the modern development languages. Basically it's a markup written somewhere in your code, outside a method or a class, which triggers some action. For example, in Atlas' [RESTful API](restful.md), there are an annotation ```@route(path: 'some/path', method: 'GET')```, which tells the API that all the code in the current method must be run everytime the given path is requested through GET method.

Most times, this kind of feature does help the code stay very clean. PHP doesn't support this feature natively, that's why it is implemented the way it is. To use PHP annotations over Atlas infrasctructure, you must declare it inside your documentation blocks.

```php
/**
 * This is a class-level documentation block.
 * @annotation this is an annotation identifier
 */
class{

	/**
	 * This is a method-level documentation block.
	 * @annotation this is an annotation identifier
	 */
	public function someMethod{
		// some code
	}
}
```

To parse the annotations you are using in your code and do whatever you want, you must use extend ```core\control\tools\Annotation```  in your parser class. This way, you'll have access to a method ```$this->parse()``` which will do all the tricky part to identify every annotation in the class. You may create your own method to process your annotation and define what each should trigger.

For example, let's create an annotation that will trigger a method to be executed as a unit test routine. The class will be like

```php
class Foo{
	
	public function myMethod(){
		return 1;
	}

	/**
	 * Executes everytime a new object is created
	 * @return void
	 * @test
	 */
	public function myTestRoutine(){
		if($this->myFirstMethod() == 1)
			return true;
		else
			return false;
	}
}
```

Now we have to create the annotation dealer

```php
class FooAnnotation extends Annotation{
	
	public function __construct(Foo $obj){
		parent::__construct($obj);
	}

	public function process(){
		$this->parse();
		foreach ($this->getAnnotations() as $method => $annotations) {
			$data = $annotations;
			if(!isset($data->functions)) continue;
			$obj = $this->getSourceObject();
			foreach($data->variables as $v){
				if($v=='test'){
					if( !$obj->$method() ) throw new \ErrorException("Test failed in Foo::myTestRoutine");
				}else{
					echo("Everything is up and fine!");
				}
			}
		}
		return false;
	}
}
```

For the last, but not less important, you must init the routine somehow. For example

```php
...
$foo = new Foo();
$annotation = new FooAnnotation($foo);
$annotation->process();
...
```

The output will be:

	Everything is up and fine!

Note: [Annotation - API reference](../../api/classes/core.control.Annotation.html)