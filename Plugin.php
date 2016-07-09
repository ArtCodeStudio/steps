<?php namespace JumpLink\Steps;
include("vendor/autoload.php");
use Backend;
use System\Classes\PluginBase;
use Config;
use JumpLink\Steps\Models\StepsSettings;


//require "./vendor/php-client/INWX/Domrobot.php";
//use ChromePhp;
/*https://octobercms.com/docs/plugin/components#component-assets*/

/**
 * steps Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Steps',
            'description' => 'jQuery Steps Plugin for OctoberCMS',
            'author'      => 'Marc Wensauer (JumplinkNetwork)',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            '\JumpLink\Steps\Components\Steps' => 'steps'
        ];
    }

    function setDefaultValues() {

        /*
         * Read Settings from DataBase
         */
        $settings = StepsSettings::instance();
        $steps_name = $settings->steps_name;
        $steps_javascript = $settings->steps_javascript;

        // print_r($settings->steps_steps);die;
        /*
         * read from /plugins/jumplink/steps/config/config.php
         */
//         $steps_steps = Config::get('jumplink.steps::steps_steps');
//         print_r($steps_steps);
//    die;
        /*
         * Check if Database Settings exists, if no use File Based Config
         */
        if(!$settings->steps_name){
            StepsSettings::set("steps_name", Config::get('jumplink.steps::steps_name'));
        }
        if(!$settings->steps_javascript){
            //StepsSettings::set("steps_javascript", Config::get('jumplink.steps::steps_javascript'));
        }
        if(!$settings->steps_items){
            StepsSettings::set("steps_items",  Config::get('jumplink.steps::steps_items') );
        }
        if(!$settings->steps_header){
            StepsSettings::set("steps_header",  Config::get('jumplink.steps::steps_header') );
        }
    }

    public function registerSettings() {
        $this->setDefaultValues();
        return [
            'settings' => [
                'label'       => 'Steps',
                'description' => 'Configure the Steps Steps',
                'category'    => 'Marketing',
                'icon'        => 'icon-cog',
                'class'       => 'JumpLink\Steps\Models\StepsSettings',
                'order'       => 1
            ]
        ];
    }




    function __construct() {
           // ChromePhp\ChromePhp::log('plugins/daslicht/contact Contact.php, onRender');

       // die;

    }




}
