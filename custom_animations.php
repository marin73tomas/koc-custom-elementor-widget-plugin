<?php

function my_entrance_animations()
{
     return array(
          'Basic Scale Animations' => [
               'stretchLeft' => 'Strentch Left',
               'stretchRight' => 'Stretch Right',
               'stretchDown' => 'Strentch Down',
               'stretchUp' => 'Strentch Up',
          ],

          'Whole Screen Slide Animations' => [
               'slideRightToLeftScreenChild' => 'Slider Right to Left',
               'slideLeftToRightScreenChild' => 'Slider Left to Right',
          ],
          'From Sides' => [
               'inFromTop' => 'In From Top',
               'inFromBottom' =>  'In From Bottom',
               'inFromLeft' =>  'In From Left',
               'inFromRight' =>  'In From Right',
          ]
     );
}
add_filter('elementor/controls/animations/additional_animations', 'my_entrance_animations');