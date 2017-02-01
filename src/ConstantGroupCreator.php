<?php

namespace GGG\Config;

class ConstantGroupCreator
{

  private $group;

  public function __construct( $assoc )
  {
    if( is_array( $assoc ) && count( $assoc ) >= 1 && (! isset( $assoc[0] ) ) )
    {
      $this->group = $assoc;
    }
    else
    {
      $error = NULL;
      if(! is_array( $assoc ) )
      {
        $error = 'not a valid array; value must be an associative array with string as its indexes';
      }
      elseif( count( $assoc ) < 1 )
      {   
        $error = 'an empty array; value must not be an empty array';
      }
      elseif( isset( $assoc[0] ) )
      {
        $error = 'an array indexed with integers; an associative array with strings as its indexes is required';
      }
      trigger_error( 'Error in the ' . __CLASS__ . ' class&apos;s ' . __FUNCTION__ . ' method, regarding its first, and only, argument: the value provided ' . $error . '.' );
    }
    return $this;
  }

  public function getConstantGroup()
  {
    return $this->group;
  }

}