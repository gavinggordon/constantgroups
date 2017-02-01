<?php

namespace GGG\Config\Groups;

class HexColoursConstantGroup
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
    $hexcolours = json_decode( file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . 'hex_colour_data.json' ), true );
    foreach( $hexcolours as $name => $hex )
    {
      $name = 'hex ' . $name;
      $this->group[ $name ] = $hex;
    }
  }

  public function getConstantGroup()
  {
    return $this->group;
  }

}