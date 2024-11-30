<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2024 webtrees development team
 *                    <http://webtrees.net>
 *
 * ChangeLanguageWithURL (webtrees custom module):
 * Copyright (C) 2024 Markus Hemprich
 *                    <http://www.familienforschung-hemprich.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * 
 * ChangeLanguageWithURL
 *
 * A webtrees 2.1/2.2 custom module to change the webtrees language 
 * by URL requests with the language provided as an URL parameter.
 *  
 */ 

declare(strict_types=1);

namespace Jefferson49\Webtrees\Module\ChangeLanguageWithURL;

use Composer\Autoload\ClassLoader;

$loader = new ClassLoader();
$loader->addPsr4('Jefferson49\\Webtrees\\Module\\ChangeLanguageWithURL\\', __DIR__);
$loader->register();

return new ChangeLanguageWithURL();