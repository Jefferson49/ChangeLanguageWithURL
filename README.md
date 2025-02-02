[![Latest Release](https://img.shields.io/github/v/release/Jefferson49/ChangeLanguageWithURL?display_name=tag)](https://github.com/Jefferson49/ChangeLanguageWithURL/releases/latest)
[![webtrees major version](https://img.shields.io/badge/webtrees-v2.1.x-green)](https://webtrees.net/download)
[![webtrees major version](https://img.shields.io/badge/webtrees-v2.2.x-green)](https://webtrees.net/download)

## ChangeLanguageWithURL
A [weebtrees](https://webtrees.net) 2.1/2.2 custom module to change the webtrees language by URL requests with the language provided as an URL parameter.

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
The latest release of the module was developed and tested with [webtrees 2.1.21 and 2.2.0](https://webtrees.net/download), but should also run with any other webtrees 2.1/2.2 versions.

## URL parameters to specify the language
In general, the module allows to add the language and the language after sign out as parameters to the end of the URL. The format for the URL parameters is as follows:
```HTML
language=LANGUAGE_TAG

language_after_signout=LANGUAGE_TAG|reset
```
+ with LANGUAGE_TAG = en-GB, de, fr, es, ...
+ The available language tags in webtrees can be found within the [supported webtrees languages](https://github.com/fisharebest/webtrees/tree/main/resources/lang)
+ With the following URL parameter, the language after sign out can be reset to the default, where webtrees selects the browser language after sign out:
```HTML
language_after_signout=reset
```

## URL format and Example URLs
Depending on the URL, the URL parameter for the language **needs to be added with a "&" or a "?" character**.

If the language to be added is the first URL parameter, it needs to be added with a "**?**" character:
```HTML
https://MY_SITE/webtrees/tree/MY_TREE/search-general?language=en-GB
```

If the language to be added is not the first URL parameter (i.e. another parameter with a "?" character is used before), it needs to be added with a "**&**" character:
```HTML
https://MY_SITE/webtrees/index.php?route=%2Ftree%2FMY_TREE%2Fsearch-general&language=es
```

If both the language and the language after signout shall be changed in parallel, two URL parameters can be added:
```HTML
https://MY_SITE/webtrees/index.php?route=%2Ftree%2FMY_TREE%2Fsearch-general&language=es&language_after_signout=fr
```

## Bugs and Feature Requests
If you experience any bugs or have a feature request for this webtrees custom module, you can [create a new issue](https://github.com/Jefferson49/ChangeLanguageWithURL/issues).

## License
+ [GNU General Public License, Version 3](LICENSE.md)
+ webtrees
    + webtrees: online genealogy
    + Copyright (C) 2025 [webtrees development team](http://webtrees.net)
+ ChangeLanguageWithURL (webtrees custom module)
    + Copyright (C) 2025 [Jefferson49](https://github.com/Jefferson49)

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see https://www.gnu.org/licenses/.

## Github repository  
https://github.com/Jefferson49/ChangeLanguageWithURL
