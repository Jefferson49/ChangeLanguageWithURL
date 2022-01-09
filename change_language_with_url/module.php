<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2021 webtrees development team
 * Copyright (C) 2022 Webmaster @ Familienforschung Hemprich, 
 *                    <http://www.familienforschung-hemprich.de>
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
 *
 * ChangeLanguageWithURL
 *
 * A middleware module to change the webtrees language on URL requests 
 * with the language provided as URL parameter
 * 
 * Example URL:
 * http://SOME_URL/webtrees/index.php?route=SOME_ROUTE&language=LANGUAGE_CODE
 */

declare(strict_types=1);

namespace ChangeLanguageWithURLNamespace;

require __DIR__ . '/ChangeLanguageWithURL.php';

return new ChangeLanguageWithURL();