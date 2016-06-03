## Twig-Codeigniter-Datestr

A few simple filters for Twig/Codeigniter to format a date as a human friendly string based on its relation to the current date/time as follows:
* Filter: minhrday.  Calculate the difference between the filtered date/time and the current date/time and display as follows evaluating from top to bottom:
  * If diff is >= 1 month, format the date as "Month, 'year".  Example: Jan '16
  * If diff is >= 1 day, format the date as number of days.  Example: 10d
  * If diff is >= 1 hour, format the date as number of hours.  Example: 6h
  * If diff is >= 1 minute, format the date as number of minutes.  Example: 22m
  * Otherwise, format the date as "1m"

* Filter: timeday.  Calculate the difference between the filtered date/time and the current date/time and display as follows evaluating from top to bottom:
  * If diff >= 1 year, format the date as "Month day 'year".  Example: Jan 02 '15
  * if diff >= 1 day, format the date as "Month day".  Example: Mar 19
  * Otherwise, format the date as a time.  Example: 11:35 AM

### Requirements
This filter is built on and requires usage of the Twig-Codeigniter library: https://github.com/bmatschullat/Twig-Codeigniter

It may be possible to use with other libraries as well with slight modifications.

### Installation
* Copy Datestr.php into your CI project where your Twig extensions are, probably: application/third_party/Twig/extensions

* Add the following to the __construct() method in application/libraries/Twig_library.php
```
require_once (string)APPPATH . 'third_party/Twig/extensions/Datestr.php';
```
* Add the following to the ci_function_init() method in application/libraries/Twig_library.php
```
$this->_twig_env->addExtension(new Twig_Extensions_Extension_Datestr());
```

### Usage
* Use the minhrday filter as follows
```
{{ example_date | minhrday }}
```
* Use the timeday filter as follows
```
{{ example_date | timeday }}
```
