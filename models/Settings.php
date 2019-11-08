<?php namespace Enovision\FrontendEditButton\Models;

use October\Rain\Database\Model;

class Settings extends Model {
	const SETTINGS_CODE = '';

    public $implement = [
        'System.Behaviors.SettingsModel',
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];

	public $settingsCode = 'enovision_frontendedit_settings';
	public $settingsFields = 'fields.yaml';
}