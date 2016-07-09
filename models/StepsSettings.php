<?php namespace JumpLink\Steps\Models;

use October\Rain\Database\Model;

class StepsSettings extends Model {
    
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'jumplink_steps_settings';
    public $settingsFields = 'fields.yaml';

}