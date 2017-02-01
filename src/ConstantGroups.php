<?php

namespace GGG\Config;

use \GGG\Config\Predefiner as Predefiner;
use \GGG\Config\ConstantGroupCreator as ConstantGroupCreator;

class ConstantGroups
{

  private $groups;
  private $predefiner;
  private $allowedGroups;

  public function __construct()
  {
    $this->groups = [];
    $this->predefiner = new Predefiner();
    $this->allowedGroups = [];
    $files = scandir( __DIR__ . DIRECTORY_SEPARATOR . 'Groups' );
    foreach( $files as $index => $file )
    {
      if(! in_array( $file, ['.','..'] ) )
      {
        $finfo = pathinfo( $file );
        if( $finfo['extension'] === 'php' )
        {
          preg_match( '/([a-z]+?)ConstantGroup/i', $finfo['filename'], $matches );
          $this->allowedGroups[ strtolower( $matches[1] ) ] = $matches[0];
        }
      }
    }
  }

  public function set( $groupnames )
  {
    if( is_string( $groupnames ) )
    {
      $groupname = strtolower( $groupnames );
      if( isset( $this->allowedGroups[ $groupname ] ) )
      {
        $groupClassStr = '\\GGG\\Config\\Groups\\' . $this->allowedGroups[ $groupname ];
        $groupClass = new $groupClassStr();
        $this->predefiner->set( $groupClass->getConstantGroup() );
      }
    }
    if( is_array( $groupnames ) )
    {
      foreach( $groupnames as $groupname )
      {
        $groupname = strtolower( $groupname );
        if( isset( $this->allowedGroups[ $groupname ] ) )
        {
          $groupClassStr = '\\GGG\\Config\\Groups\\' . $this->allowedGroups[ $groupname ];
          $groupClass = new $groupClassStr();
          $this->predefiner->set( $groupClass->getConstantGroup() );
        }
      }
    }
  }

  public static function create( ConstantGroupCreator $creator, $name )
  {
    $group = $creator->getConstantGroup();
    $phptag = html_entity_decode( '&lt;' ) . "?php\n";
    $name = ucwords( $name ) . 'ConstantGroup';
    $arrayText = "";
    $index = 1;
    foreach( $group as $constant => $definition )
    {
      $constant = preg_replace( '/[^a-z0-9\_]+?/i', '_', strtoupper( $constant ) );
      $arrayText .= ( $index === count( $group ) ) ? "'{$constant}' => '{$definition}'" : "'{$constant}' => '{$definition}',\n\t\t\t";
      $index++;
    }
    $groupClassFile =<<<EOT
{$phptag}
namespace GGG\Config\Groups;

class {$name}
{

  private \$group;

  public function __construct()
  {
    \$this->group = [
      {$arrayText}
    ];
  }

  public function getConstantGroup()
  {
    return \$this->group;
  }

}
EOT;

    if( file_exists( __DIR__ . DIRECTORY_SEPARATOR . 'Groups' . DIRECTORY_SEPARATOR . $name . '.php' ) )
    {
      return false;
    }
    file_put_contents( __DIR__ . DIRECTORY_SEPARATOR . 'Groups' . DIRECTORY_SEPARATOR . $name . '.php', $groupClassFile );
    return true;
  }

  public function init()
  {
    $this->predefiner->init();
  }

}