Configuring the environment with config.json
============================================

The ```application/environment/config.json``` in the file where you config important data about the way your application works. It has some predefined data that must always exist and you may add your own as you need.

* __emailAdmin__: defines the administrator's e-mail. Everytime an error occurs, this e-mail will be shown.
* __encoding__: character encoding used to show the strings in the pages.
* __baseURL__: the path in your server which describes where is located your ```index.php``` file.
* __logPath__: the path to the file in your server where you want to record your error log.
* __debugMode__: toggles debug mode on/off.
* __runTest__: toggles unit test execution befor application starts on/off.
* __tests__: array containing full-path strings pointing to the UnitTest classes delimited by ```.```.
* __database__: database server configuration array.
* __resources__: array containing full-path strings pointing to the RESTful Resource classes delimited by ```.```.
* __viewPath__: the path to search for the static files.

Note: when you first download the source, it comes with a predefined ```config.json```

Warning: some changes here may cause unexpected behavior to your system. Do it wisely!