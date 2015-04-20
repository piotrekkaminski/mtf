# Running the Magento Test Framework (MTF)

This page discusses how to run tests using the MTF.

## Prerequisite

Install and configure the MTF as discussed in [Installing and Configuring the Magento Test Framework (MTF)](install-config.md).

## Running MTF

1.	Make sure your Magento 1 or <a href="https://github.com/magento/magento2" target="_blank">Magento 2 code</a> is up-to-date.
	
2.	Change to the `dev/tests/functional` directory and run `composer update` 

	`composer update` updates any dependencies that otherwise prevent tests from running successfully. 

3.	Start Selenium (which should have been downloaded for you by Composer). Selenium can be found under the `dev/tests/functional/vendor/netwing/selenium-server-standalone` directory.

	Example of starting Selenium:

	```
	java -jar vendor/netwing/selenium-server-standalone/selenium-server-standalone-2.39.0.jar
	```
	
	**Note**: Your version might differ from the example above.

3.	Start your tests using PHPUnit. This can be done using your IDE or the command line.

	Example using the command line:
	
	**Note**: In Magento 1 you might need to call `vendor/bin/phpunit` instead.

	```
	cd dev/tests/functional
	phpunit
	```
	
