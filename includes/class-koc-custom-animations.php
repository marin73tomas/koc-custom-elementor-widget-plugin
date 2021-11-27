<?php
if (!class_exists('KOC_Custom_Animations')) {

     class KOC_Custom_Animations
     {
          public function __construct()
          {
               add_filter('elementor/controls/animations/additional_animations', array($this, 'animations'));
          }
          function animations()
          {
               return array(
                    'Basic Scale Animations' => [
                         'stretchLeft' => 'Strentch Left',
                         'stretchRight' => 'Stretch Right',
                         'stretchDown' => 'Strentch Down',
                         'stretchUp' => 'Strentch Up',
                    ],

                    'From Sides' => [
                         'inFromTop' => 'In From Top',
                         'inFromBottom' =>  'In From Bottom',
                         'inFromLeft' =>  'In From Left',
                         'inFromRight' =>  'In From Right',
                    ]
               );
          }
     }
     new KOC_Custom_Animations();
}
