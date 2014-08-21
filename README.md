Price Scraper
====================

Utility to crawl and parse e-commerce URLs to extract pricing data.

Setup
-----

Requirements:

* PHP 5.4+
* MySQL 5.5+
* GIT

1. Get [Composer]
```
$ cd
$ mkdir -p bin
$ cd bin
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar composer
$ chmod +x composer
```
(make sure `~/bin` is in your PATH)

2. Create database
```
$ mysql -uroot -p
mysql> CREATE DATABASE pc;
mysql> GRANT ALL ON pc.* TO pc@localhost WITH GRANT OPTION;
mysql> SET PASSWORD FOR pc@localhost = password('pc');
mysql> Ctrl+D
```

3. Checkout the code from the [bitbucket repository]
```
$ cd ~/workspace
$ git clone git@github.com:virfaure/price-scraper.git
$ cd price-scraper
$ chmod +x console
```

4. Install dependencies
```
$ composer install
```

5. Configure database connection and mail options
```
$ cp config.ini.sample config.ini
$ vi config.ini
```

6. Create data SQL (optional)
```
$ cd data
$ ./csv_to_data > mysql-data.sql
```

7. Dump data into database
```
$ mysql -upc -p pc < mysql-schema.sql
$ mysql -upc -p pc < mysql-data.sql
$ mysql -upc -p pc < mysql-spiders.sql
```

Structure
---------
* `composer.json`: dependencies and autoloading definitions
* `config.ini`: configuration file
* `console` script: shell entry point (see below)
* `data`: data folder (not necessary in production env)
* `src`:
  * `Command`: shell commands
  * `Model`: active record models
  * `Spider`: spiders
  * `Test`: unit tests
* `vendor`: third party libraries

Components
----------

This project uses the following components (amongst others):

* [fabpot/goutte] - Simple PHP Web Scraper
* [j4mie/idiorm] - ORM (used by Paris)
* [j4mie/paris] - Active Record implementation
* [symfony/console] - Shell commands interface
* [symfony/dom-crawler] - DOM navigation (used by Goutte)
* [symfony/css-selector] - CSS selector to XPath (used by Goutte)
* [phpmailer/phpmailer] - The classic email sending library for PHP
* [respect/config] - Configuration and dependency injector container
* [phpunit/phpunit] - Haven't you heard about this one? Fired!
* [lstrojny/phpunit-clever-and-smart] - Nice addon for phpunit that sorts tests based on previous results

Using it
--------

From the root of the project:
```
$ ./console
Console Tool

Usage:
  [options] command [arguments]

Options:
  --help           -h Display this help message.
  --quiet          -q Do not output any message.
  --verbose        -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  --version        -V Display this application version.
  --ansi              Force ANSI output.
  --no-ansi           Disable ANSI output.
  --no-interaction -n Do not ask any interactive question.

Available commands:
  help          Displays help for a command
  list          Lists commands
tet
  tet:harvest   Harvest data from websites
  tet:report    Generates reports
```

Inspect the options
```
$ console help tet:harvest
$ console help tet:report
```

Spider Creation Guide
---------------------

Tips to create new spiders

* Read the code of existing ones
* All spiders must extend `Spider` class
* All spiders must be in `TET\Spider` namespace 
* Get some URLs with different corner cases and write a Unit Test first under `src/Test/Spider`
* Install and use `SelectorGadget` extension for Chrome (optional but highly recommended)
* Use `$crawler->filter('...')->each(function($node) { ... });` whenever possible
* Else, check your nodes always:
```
$node = crawler->filter('...')->first();
if ($node->count()) {...}
```
* Run your tests to check completion
```
$ vendor/bin/phpunit --testsuite spiders
```

By default the tests only check that the spider returns any result (i.e. that it finds prices in the page).
You can change this behaviour with an inline environment variable. Possible values are: 1 (default, returns something),
2 (returns the expected number of rows) or 3 (the prices match). Example:

```
$ TEST_LEVEL=2 vendor/bin/phpunit --testsuite spiders
```

Tests are being configured so that new executions start testing previous errors (thanks to phpunit-clever-and-smart).
It might be also interesting to stop execution on error:
```
$ vendor/bin/phpunit --stop-on-error --testsuite spiders
```

To get a coverage report:
```
$ vendor/bin/phpunit --coverage-html ./.phpunit --testsuite spiders
$ google-chrome .phpunit/index.html
```
