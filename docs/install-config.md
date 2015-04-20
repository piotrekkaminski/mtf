# Installing and Configuring the Magento Test Framework (MTF)

This page discusses how to install the MTF.

## Contents

*	[Prerequisites](#prerequisites)
*	[Installation Procedure](#installation-procedure)
*	[Configuring the MTF](#configuring-the-mtf)
*	[Configuration File Reference](#configuration-file-reference)
*	[Next Step](#next-step)

## Prerequisites

This section discusses prerequisites for using the MTF.

### Supported Operating Systems

You can use the MTF on Windows, Mac OS, Ubuntu, or CentOS.

### Required Software

*	PHP: You must enable the `openssl` extension to download files using HTTPS.

*	<a href="https://code.google.com/p/selenium/source/browse/README.md#112" target="_blank">Java version 1.6 or later</a> is required; we recommend the latest update to Java 1.7.

	Also, the `java` and `jar` executables must be in your system PATH. 

	To see your current Java version, enter `java -version` at the command line. If Java is not recognized, make sure it's in your system PATH.
	
	For general information, see the <a href="http://www.java.com/en/download/help/index_installing.xml" target="_blank">installing Java help page</a>.
	
	Another resource is the <a href="http://www.java.com/en/download/help/java_update.xml" target="_blank">using Java help page</a>.

### Magento 1 Configuration

Magento 1 must be installed and configured to not use the secret URL key. 

1.	Log in to the Magento Admin as an administrator.

2.	Click **System** > **Configuration** > **Admin** > **Security**

3.	Set **Add Secret Key to URLs** to **No**.
	
### Magento 2 Configuration

<a href="https://github.com/magento/magento2" target="_blank">Magento 2</a> must be installed and configured to not use the secret URL key. 

1.	Log in to the Magento Admin as an administrator.

2.	Click **Stores** > **Configuration** > **Advanced** > **Admin** > **Security**. 

3.	Set **Add Secret Key to URLs** to **No**.

### Git

Git must be installed.
	
For Windows only: Add Git to your system PATH variable or run Composer from the Git bash shell.

### Web Browser

If you use a web browser other than Firefox, you must get <a href="http://docs.seleniumhq.org/download/" target="_blank">web browser drivers</a> that are compatible with Selenium. 

For more information about web browser support, see <a href="http://docs.seleniumhq.org/docs/01_introducing_selenium.jsp#supported-browsers-and-platforms" target="_blank">the Selenium documentation</a>.

## Installation Procedure

1.	Download Composer for <a href="http://getcomposer.org/doc/00-intro.md#installation-nix" target="_blank">UNIX</a> or <a href="http://getcomposer.org/doc/00-intro.md#installation-windows" target="_blank">Windows</a>. 

2.	Follow the instructions on that page to install Composer.

3.	Run Composer from the `[your Magento install dir]/dev/tests/functional` directory as follows:

	```
	composer install
	```
	
	If you cannot run `composer` from the command line, do the following:
	
	a.	Copy `composer.phar` into the directory where `composer.json` is located (typically `[your Magento install dir]/dev/tests/functional`). 
	
	**Note**: `composer.json` contains dependency information and settings for PHPUnit, Selenium server, libraries, and so on required to start MTF. It also checks MTF out from a separate repository.
	
	b.	Run Composer as follows:
	
	```
	php composer.phar install
	```
	
	A new directory named `vendor` is created with the checked-out MTF. The `vendor` directory contains:

    <ul><li>An MTF framework directory (<tt>magento/mtf</tt>)</li>
   <li><tt>bin </tt></li>
   <li><tt>composer</tt></li>
   <li><tt>netwing</tt> </li>
   <li><tt>phpunit</tt></li>
   <li><tt>symfony</tt> </li>
   <li><tt>autoload.php</tt> (file)</li></ul>
   
   **Note**: Specific versions of Selenium are compatible with specific versions of browsers. You might need to manually download and update Selenium to match your browser version. 

4.	Run the generator from `[your Magento install dir]/dev/tests/functional/utils/generate.php`

	```
	php utils/generate/factory.php
	```
	
	**Note**: The generator tool creates factories for fixtures, handlers, repositories, page objects, and block objects. After the MTF is initialized, the factories are pre-generated to facilitate creating and running the tests.
	
	The generator creates generated directories containing factories for pages, blocks, handlers, fixtures and repositories.

## Configuring the MTF

This section discusses how to configure the MTF. 

### Non-Firefox Browser Prerequisite

If you run your tests using a web browser _other than_ Firefox, add configuration for your browser to `[your Magento install dir]/dev/tests/functional/etc/config.xml`. A sample follows:

```xml
<server>
	<item name="selenium" type="default" browser="Google Chrome" browserName="chrome" host="localhost" port="4444" seleniumServerRequestsTimeout="90" sessionStrategy="shared">
		<desiredCapabilities>
			<platform>ANY</platform>
		</desiredCapabilities>
	</item>
</server>
```

For more information about web browser support, see <a href="http://docs.seleniumhq.org/docs/01_introducing_selenium.jsp#supported-browsers-and-platforms" target="_blank">the Selenium documentation</a>.

### Specifying Your Magento URLs

Specify your storefront and Magento Admin URLs in `phpunit.xml`:

```xml
<env name="app_frontend_url" value="http://localhost/magento2/index.php/"/>
<env name="app_backend_url" value="http://localhost/magento2/index.php/backend/"/>
```
	
## Configuration Reference

This section provides information about MTF configuration sections. All sections discussed here are located in `[your Magento install dir]/dev/tests/functional/etc/config.xml`

For more information, see:

*	[application](#application)
*	[isolation](#isolationyml)
*	[server](#serveryml)

#### application

Sample:

```xml
<application>
	<reopenBrowser>testCase</reopenBrowser>
	<backendLogin>admin</backendLogin>
	<backendPassword>123123q</backendPassword>
	<backendLoginUrl>admin/auth/login</backendLoginUrl>
</application>
```

*	`reopenBrowser` defines whether a browser should be reopened before every test or before every test case. Default behavior is for browser to open before every test case.
*	`backendLogin` and `backendPassword` defines the Magento Admin administrator user name and password.
*	`backendLoginUrl` defines the Magento Admin login URL.

#### isolation

Responsible for specifying the isolation strategies for tests, cases, and suites. 

Sample:

```xml
<isolation>
	<resetUrlPath>dev/tests/mtf/isolation.php</resetUrlPath>
	<testSuite>before</testSuite>
	<testCase>none</testCase>
	<test>none</test>
</isolation>
```

Your _isolation strategy_ determines when a system should return to its initial state. Isolation strategy can apply to any scope; that is, to a test, case, or suite. There are four isolation strategies available in the MTF:

*	`none`: Default strategy; implies that the isolation script should not be run either before or after any test, case, or suite.
*	`before`: Implies that the isolation script should be run before a test, case, or suite.
*	`after`: Implies that the isolation script should be run after a test, case, or suite.
*	`both`: Implies that the isolation script should be run both before and after a test, case, or suite.

#### server

Specify the Selenium web browser (if not Firefox) and other options. For a list of valid `browserName` values, see:

*	<a href="http://selenium.googlecode.com/svn/trunk/docs/api/py/_modules/selenium/webdriver/common/desired_capabilities.html" target="_blank">Selenium source code</a> 
*	<a href="http://stackoverflow.com/questions/2569977/list-of-selenium-rc-browser-launchers" target="_blank">This article on stackoverflow</a>

Sample:

```xml
<server>
	<item name="selenium" type="default" browser="Mozilla Firefox" browserName="firefox" host="localhost" port="4444" seleniumServerRequestsTimeout="90" sessionStrategy="shared">
		<desiredCapabilities>
			<platform>ANY</platform>
		</desiredCapabilities>
	</item>
</server>
```

## Next Steps

Start running as discussed in [Running the Magento Test Framework (MTF)](running.md).
