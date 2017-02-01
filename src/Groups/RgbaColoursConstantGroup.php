<?php

namespace GGG\Config\Groups;

class RgbaColoursConstantGroup
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
    $rgbacolours = json_decode( file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . 'rgba_colour_data.json' ), true );
    foreach( $rgbacolours as $name => $rgba )
    {
      $name = 'rgba ' . $name;
      $this->group[ $name ] = $rgba;
    }
  }

  public function getConstantGroup()
  {
    return $this->group;
  }

}