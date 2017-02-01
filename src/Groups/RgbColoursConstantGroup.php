<?php

namespace GGG\Config\Groups;

class RgbColoursConstantGroup
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
    $rgbcolours = json_decode( file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . 'rgb_colour_data.json' ), true );
    foreach( $rgbcolours as $name => $rgb )
    {
      $name = 'rgb ' . $name;
      $this->group[ $name ] = $rgb;
    }
  }

  public function getConstantGroup()
  {
    return $this->group;
  }

}