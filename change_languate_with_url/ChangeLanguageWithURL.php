<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2021 webtrees development team
 * Copyright (C) 2022 Webmaster @ Familienforschung Hemprich, http://www.familienforschung-hemprich.de
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

use Fisharebest\Localization\Locale;
use Fisharebest\Localization\Locale\LocaleInterface;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\LanguageEnglishUnitedStates;
use Fisharebest\Webtrees\Module\LanguageGerman;
use Fisharebest\Webtrees\Module\ModuleLanguageInterface;
use Fisharebest\Webtrees\Services\ModuleService;
use Fisharebest\Webtrees\Session;
use Fisharebest\Webtrees\Site;
use Generator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function str_contains;

//For Gedcom export
use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\GedcomRecord;
use Fisharebest\Webtrees\Http\ViewResponseTrait;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Services\GedcomExportService;
use Fisharebest\Webtrees\Tree;
use Illuminate\Database\Capsule\Manager as DB;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use RuntimeException;
use function addcslashes;
use function app;
use function assert;
use function fclose;
use function fopen;
use function pathinfo;
use function rewind;
use function strtolower;
use function tmpfile;


class ChangeLanguageWithURL extends AbstractModule implements ModuleCustomInterface, MiddlewareInterface {

    use ModuleCustomTrait;
  
    /**
     * How should this module be identified in the control panel, etc.?
     *
     * @return string
     */
    public function title(): string
    {
        return 'ChangeLanguageWithURL module';
    }

    /**
     * Code here is executed before and after we process the request/response.
     * We can block access by throwing an exception.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Code here is executed before we process the request/response.
	
		$params = $request->getQueryParams();
		$language = $params['language'] ?? '';
					
		if ($language !== '') {
			I18N::init($language);
			Session::put('language', $language);
		}
					
        // Generate the response.
        return $handler->handle($request);	
	
    }
}
