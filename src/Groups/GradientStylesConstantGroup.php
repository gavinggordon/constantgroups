<?php

namespace GGG\Config\Groups;

class GradientStylesConstantGroup
{

  private $group;

  public function __construct()
  {
    $this->group = [];
    $this->setConstantGroup();
    return $this;
  }

  private function setConstantGroup()
  {
    $gradientstyles = json_decode( file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . 'gradient_style_data.json' ), true );
    foreach( $gradientstyles as $name => $style )
    {
      $name = 'gradient ' . $name;
      $this->group[ $name ] = $style;
    }
  }

  public function getConstantGroup()
  {
    return $this->group;
  }

}