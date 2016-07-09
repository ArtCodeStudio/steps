<?php

return [

"steps_name" => "JumpLink Steps",


"steps_javascript" => 
"
/*
This is the defaul JavaScript see: /plugins/jumplink/steps/config/config.php
It is initialized here: /plugins/jumplink/steps/Plugin.php @registerSettings()
 
Add some Items on the html Tab and enter some content to get started
*/
$('#jumplink_steps').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    transitionEffect: 'slideLeft',
    autoFocus: true
});",

"steps_header" => "foo",
 
"steps_items" => [
    [
        "steps_step_title" => "First Item",
        "steps_step_code" => "Fisrt Item"
    ],
    [
        "steps_step_title" => "Second Item",
        "steps_step_code" => "Second Item"
    ]
]

];