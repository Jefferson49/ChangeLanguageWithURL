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
 * Github repository: https://github.com/Jefferson49/ChangeLanguageWithURL
 *
 * A weebtrees(https://webtrees.net) 2.0 custom module  to change the webtrees 
 * language on URL requests with the language provided as URL parameter
 *  
 */
 

declare(strict_types=1);

namespace ChangeLanguageWithURLNamespace;

use Fisharebest\Localization\Locale;
use Fisharebest\Localization\Locale\LocaleInterface;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleLanguageInterface;
use Fisharebest\Webtrees\Services\ModuleService;
use Fisharebest\Webtrees\Session;
use Fisharebest\Webtrees\Site;
use Fisharebest\Webtrees\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;




class ChangeLanguageWithURL extends AbstractModule implements ModuleCustomInterface, MiddlewareInterface {

    use ModuleCustomTrait;
	
    /**
     * Initialization.
     *
     * @return void
     */
    public function boot(): void
    {
		// Register a namespace for our views.
		View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
	}  
	
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
     * Where does this module store its resources
     *
     * @return string
     */
    public function resourcesFolder(): string
    {
		return __DIR__ . '/resources/';
    }

  	 /**
     * Show error message in the front end
     *
     * @return ResponseInterface
     */ 

    private function showErrorMessage(string $text): ResponseInterface
    {		
       return $this->viewResponse($this->name() . '::error', [
           'title'        	=> 'Error',
           'tree'			=> null,
           'text'  	   	=> I18N::translate('Custom module') . ': ' . $this->name() . '<br><b>'. $text . '</b>',
       ]);	 
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

		if ($language != '') {	
            
			$locales = I18N::activeLocales();	
			$language_found = false; 		

			foreach (I18N::activeLocales() as $locale) {
				if ($locale->languageTag() == $language) {
					$language_found = true;
				}
			}

			if ($language_found) {
				I18N::init($language);
				Session::put('language', $language);
			}
			else {
				//Show error message
                return $this->showErrorMessage(I18N::translate('Requested language tag not found') . ': ' . $language);
			}		
		}
		
        // Generate the response
        return $handler->handle($request);		
    }
}