<?php namespace JumpLink\Steps\Components;

use Cms\Classes\ComponentBase;
use JumpLink\Steps\Models\StepsSettings;
use INWX\Domrobot;
//use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Route;
class Steps extends ComponentBase

{

    public function componentDetails()
    {
        return [
            'name'        => 'Steps Component',
            'description' => 'Steps Component'
        ];
    }

    public function defineProperties()
    {
        return [
            'stepssettings' => [
                'description'       => 'Steps Component Settings',
                'title'             => 'Steps Component Settings',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '',
                'validationMessage' => 'This is the Validation Message.'
            ]
            // ,
            // 'stepssettings' => [
            //     'description'       => 'Steps Component Settings',
            //     'title'             => 'Steps Component Settings',
            //     'default'           => '',
            //     'type'              => 'string',
            //     'validationPattern' => '',
            //     'validationMessage' => 'This is the Validation Message.'
            // ]
        ];
    }
    
    public function onRender() //frontend
    {
         /* Using persisted properties */
         $settings = StepsSettings::instance();
        
         $this->page['steps_name'] = $settings->steps_name;
         $this->page['steps_items'] = $settings->steps_items;
//  $this->page['steps_javascript'] = $settings->steps_javascript;
         $this->page['steps_header'] = $settings->steps_header;
         
         
         // \ChromePhp::log('onRender:',$settings->steps_steps);
    }
    
    function onInit()
    {
         // \ChromePhp::log('onInit before AJAX');
 
    }
    
    public function onRun()
    {
        $settings = StepsSettings::instance();
       // \ChromePhp::log('onRun, Steps:', Settings::get('stepssettings')); 
       // \ChromePhp::log('steps_javascript:',$settings->steps_javascript);
        
        $this->addJs('/plugins/jumplink/steps/assets/vendor/jquery.steps/build/jquery.steps.min.js');
        $this->addJs('/plugins/jumplink/steps/components/steps.js');
        $this->addCss('/plugins/jumplink/steps/assets/jquery.steps.css');
        //\ChromePhp::log('onRun, steps/components/steps.php line ~72');
        Route::get('/foo', function () {
            return 'Hello World';
        });
      //  $this-> onCheckDomain();
    
    }


    /*
     * AJAX HANDLER
     */
    public function onCheckDomain() {
   

            $addr = "https://api.domrobot.com/xmlrpc/";
            //$addr = "https://api.ote.domrobot.com/xmlrpc/";
            $usr = "daslicht";
            $pwd = "Fxh7kDMYuhbedruZayjVTnUBysEiGnmp";

            $domrobot = new Domrobot($addr);
          
            $domrobot->setDebug(false);
            $domrobot->setLanguage('en');
            $res = $domrobot->login($usr,$pwd);
            $domainToCheck = post("domainInput");
  //         $domainToCheck = ""
// //post("domainInput");
//              \ChromePhp::log(  $_POST['domainInput']);
// die;
            if ($res['code'] == 1000  ) {
                //echo "1000";
            	$obj = "domain";
            	$meth = "check";
            	$params = array();
            	$params['domain'] = post("domainInput");
            	$res = $domrobot->call($obj,$meth,$params);
            	// print_r($res);
                $result = $res['resData']['domain'][0]['avail']; // 1= available 
                // \ChromePhp::log('res?',$res['resData']['domain'][0]['avail']);
                
                 if($result== 1){
                    $data = array(
                        "result" => 1
                    );
                 }else{
                    $data = array(
                        "result" => 0
                    );
                 }

                return $data;

            } else {
               // \ChromePhp::log('$data?',$data);
                //echo $result;
            }
            
            $res = $domrobot->logout();
      
      
    }

  
       
}