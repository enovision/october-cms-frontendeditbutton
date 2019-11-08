<?php

namespace Enovision\FrontendEditButton;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;

use Backend\Facades\BackendAuth;
use Backend\Facades\Backend;

use Enovision\FrontendEditButton\Models\Settings;

use Cookie;

class Plugin extends PluginBase {

	private $_user = null;
	private $isLoggedIn = false;

	public function registerComponents() {
		return [
			'Enovision\FrontendEditButton\Components\EditButton' => 'frontendeditbutton'
		];
	}

	public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'enovision.frontendeditbutton::lang.settings.label',
                'description' => 'enovision.frontendeditbutton::lang.settings.description',
                'icon'        => 'oc-icon-circle-o',
                'category'    =>  SettingsManager::CATEGORY_MYSETTINGS,
                'class'       => 'Enovision\FrontendEditButton\Models\Settings',
                'order'       => 100
            ]
        ];

    }

	public function boot() {
		$this->isLoggedIn = BackendAuth::check();
		$this->_user      = BackendAuth::getUser();

		$admin  = Cookie::get('admin_auth');

	}
}
