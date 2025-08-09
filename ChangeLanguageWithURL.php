<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2025 webtrees development team
 *                    <http://webtrees.net>
 *
 * ChangeLanguageWithURL (webtrees custom module):
 * Copyright (C) 2025 Markus Hemprich
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

use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Session;
use Fisharebest\Webtrees\Site;
use Fisharebest\Webtrees\View;
use Jefferson49\Webtrees\Exceptions\GithubCommunicationError;
use Jefferson49\Webtrees\Helpers\GithubService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


class ChangeLanguageWithURL extends AbstractModule implements ModuleCustomInterface, MiddlewareInterface {

    use ModuleCustomTrait;

	//Custom module version
	public const CUSTOM_VERSION = '1.2.2';

    //Github repository
	public const GITHUB_REPO = 'Jefferson49/ChangeLanguageWithURL';

	//Github API URL to get the information about the latest releases
	public const GITHUB_API_LATEST_VERSION = 'https://api.github.com/repos/'. self::GITHUB_REPO . '/releases/latest';
	public const GITHUB_API_TAG_NAME_PREFIX = '"tag_name":"v';

	//Author of custom module
	public const CUSTOM_AUTHOR = 'Markus Hemprich';

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
     * {@inheritDoc}
     *
     * @return string
     *
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleAuthorName()
     */
    public function customModuleAuthorName(): string
    {
        return self::CUSTOM_AUTHOR;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     *
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleVersion()
     */
    public function customModuleVersion(): string
    {
        return self::CUSTOM_VERSION;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     *
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleLatestVersion()
     */
    public function customModuleLatestVersion(): string
    {
        return Registry::cache()->file()->remember(
            $this->name() . '-latest-version',
            function (): string {

                try {
                    //Get latest release from GitHub
                    return GithubService::getLatestReleaseTag(self::GITHUB_REPO);
                }
                catch (GithubCommunicationError $ex) {
                    // Can't connect to GitHub?
                    return $this->customModuleVersion();
                }
            },
            86400
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     *
     * @see \Fisharebest\Webtrees\Module\ModuleCustomInterface::customModuleSupportUrl()
     */
    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/' . self::GITHUB_REPO;
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
     * Whether a language tag belongs to an active language
     * 
     * @param string $language_tag
     *
     * @return bool
     */ 
    public static function isActiveLanguage(string $language_tag): bool 
    {
        $language_found = false;

        foreach (I18N::activeLocales() as $locale) {
            if ($locale->languageTag() === $language_tag) {
                $language_found = true;
                break;
            }
        }
        return $language_found;
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
		$params                 = $request->getQueryParams();
		$language               = $params['language'] ?? '';
		$language_after_signout = $params['language_after_signout'] ?? '';

		if ($language_after_signout === 'reset') {
            Site::setPreference('LANGUAGE_AFTER_SIGNOUT', '');
        }        
		elseif ($language_after_signout !== '') {	
            
			if (self::isActiveLanguage($language_after_signout)) {
				Site::setPreference('LANGUAGE_AFTER_SIGNOUT', $language_after_signout);
            }
			else {
				//Show error message
                return $this->showErrorMessage(I18N::translate('Requested language tag not found') . ': ' . $language_after_signout);
			}		
		}

        //Set language after sign out
        if(!Auth::check() && Site::getPreference('LANGUAGE_AFTER_SIGNOUT') !== '') {

            Session::put('language', Site::getPreference('LANGUAGE_AFTER_SIGNOUT'));
        }

        //Set language
		if ($language !== '') {	
            
			if (self::isActiveLanguage($language)) {

				I18N::init($language);
				Session::put('language', $language);
            }
			else {
				//Show error message
                return $this->showErrorMessage(I18N::translate('Requested language tag not found') . ': ' . $language);
			}		
		}

        return $handler->handle($request);		
    }
}