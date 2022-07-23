## ChangeLanguageWithURL
A [weebtrees](https://webtrees.net) 2.x module to change the webtrees language by URL requests with the language provided as an URL parameter.

## What are the benefits of this module?
+ Change the webtrees language without interaction in the user interface (webtrees front end)
+ Add a language change request to any existing webtrees URL
+ Provide a language mechanism for an integration of webtrees into a content management system (CMS)
    + If webtrees is integrated into a content management system (e.g. [joomla](https://www.joomla.org) ), the languages can be aligned between the CMS and webtrees
    + The purpose of the module is to handover the CMS language to webtrees using a specific URL parameter. If the module receives the URL parameter, the language in webtrees is changed accordingly

## Installation  
+ Download the [latest release](https://github.com/Jefferson49/ChangeLanguageWithURL/releases/latest) of the module
+ Copy the folder "change_language_with_url" into the "module_v4" folder of your webtrees installation
+ Check if the module is activated in the control panel:
    + Login to webtrees as an administrator
	+ Go to "Control Panel/All Modules", and find the module called "ChangeLanguageWithURL"
	+ Check if it has a tick for "Enabled"

## Webtrees version  
The latest release of the module was developed and tested with [webtrees 2.1.4](https://webtrees.net/download), but should also run with any other webtrees 2.0 and 2.1 version.

## Github repository  
https://github.com/Jefferson49/ChangeLanguageWithURL

## URL format  
http://SOME_URL/webtrees/index.php?route=SOME_ROUTE&language=LANGUAGE_TAG

Example language tags (to use for LANGUAGE_TAG): en-GB, de, fr, es

## Example URL  
http://SOME_URL/webtrees/index.php?route=/webtrees/tree/tree1/my-page&language=en-GB
