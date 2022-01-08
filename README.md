# ChangeLanguageWithURL
A [weebtrees](https://webtrees.net) 2.0 module to change the webtrees language by URL requests with the language provided as an URL parameter.

The module is especially useful if webtrees is integrated into a content management system (e.g. [joomla](https://www.joomla.org) ) and the languages need to be aligned between the CMS and webtrees. The purpose of the module is to handover the CMS language to webtrees, using a specific URL parameter. If the module receives the URL parameter, the language in webtrees is changed accordingly.

**Example URL:**   
http://SOME_URL/webtrees/index.php?route=SOME_ROUTE&language=LANGUAGE_CODE

The module was developed and tested with [webtrees 2.0.19](https://webtrees.net/download)
