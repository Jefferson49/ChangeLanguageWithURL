## ChangeLanguageWithURL
A [weebtrees](https://webtrees.net) 2.1 custom module to change the webtrees language by URL requests with the language provided as an URL parameter.

## What are the benefits of this module?
+ Change the webtrees language without interaction in the user interface (webtrees front end)
+ Add a language change request to any existing webtrees URL
+ Provide a language mechanism for an integration of webtrees into a content management system (CMS)
    + If webtrees is integrated into a content management system (e.g. [Joomla](https://www.joomla.org) ), the languages can be aligned between the CMS and webtrees
    + The purpose of the module is to handover the CMS language to webtrees using a specific URL parameter. If the module receives the URL parameter, the language in webtrees is changed accordingly

## Installation  
+ Download the [latest release](https://github.com/Jefferson49/ChangeLanguageWithURL/releases/latest) of the module
+ Copy the folder "change_language_with_url" into the "module_v4" folder of your webtrees installation
+ Check if the module is activated in the control panel:
    + Login to webtrees as an administrator
	+ Go to "Control Panel/All Modules", and find the module called "ChangeLanguageWithURL"
	+ Check if it has a tick for "Enabled"

## Webtrees version  
The latest release of the module was developed and tested with [webtrees 2.1.4](https://webtrees.net/download), but should also run with any other webtrees 2.1 versions.

## URL format  
http://SOME_URL/webtrees/index.php?route=SOME_ROUTE&language=LANGUAGE_TAG

Example language tags (to use for LANGUAGE_TAG): en-GB, de, fr, es

## Example URL  
http://SOME_URL/webtrees/index.php?route=/webtrees/tree/tree1/my-page&language=en-GB

## Bugs and Feature Requests
If you experience any bugs or have a feature request for this webtrees custom module, you can [create a new issue](https://github.com/Jefferson49/ChangeLanguageWithURL/issues).

## License
+ [GNU General Public License, Version 3](LICENSE.md)
+ webtrees
    + webtrees: online genealogy
    + Copyright (C) 2024 [webtrees development team](http://webtrees.net)
+ ChangeLanguageWithURL (webtrees custom module)
    + Copyright (C) 2024 [Jefferson49](https://github.com/Jefferson49)

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see https://www.gnu.org/licenses/.

## Github repository  
https://github.com/Jefferson49/ChangeLanguageWithURL
