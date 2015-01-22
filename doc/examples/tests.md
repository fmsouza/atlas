Running Tests
=============

One of the most adopted development practices to create good code is the TDD (Test-Driven Development). It consists in writing test routines to prove that the application hasn't any major bugs and is very stable. Writing such routines here is ery easy. You only have to follow few rules:

* Your code must be written inside classes which extends ```core/tools/test/UnitTest```
* All these classes must be specified in the list ```tests``` in the ```config.json``` file following the pattern ```path.to.MyTest```
* To run the test routines, you must turn on the flag ```runTest``` in the ```config.json```.
* Every method you write in your test class is a test routine and it will be executed.
* If any of the routines returns an ```false``` response to the assert, it stops the execution of the application returning and exception for the test.

An example Test code is:

```php
namespace application\tests;

use core\tools\test\UnitTest;

class MainTest extends UnitTest{

    public function testIfTrue(){
        return $this->assertTrue(true); // will pass because it expects a true expression
    }

    public function testIfTwoEqualToThree(){
    	$a = 3;
    	$b = 2;
    	return $this->assertEquals($a, $b); // will stop because the comparison isn't equal
    }
    
}
```

```
// config.json
{
	...
  	"runTest": true,
	"tests": [
		"application.tests.MainTest"
	]
}
```

Note: For more information about testing assertions, check [UnitTest - API reference](../../api/classes/core.tools.test.UnitTest.html).