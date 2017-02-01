# ConstantGroups

[![Packagist Version](https://img.shields.io/packagist/v/gavinggordon/constantgroups.svg)](https://packagist.com/gavinggordon/constantgroups)
[![Github Release](https://img.shields.io/github/release/gavinggordon/constantgroups.svg)](https://github.com/gavinggordon/constantgroups/master)
[![Usage License](https://img.shields.io/github/license/gavinggordon/constantgroups.svg)](https://github.com/gavinggordon/constantgroups/blob/master/LICENSE.txt)

## Description
A PHP class which provides quick as-needed access to pre- and user defined data via constants.

## Dependencies
The following dependencies will be automatically installed, if not already, when installing via composer:

	~ [gavinggordon/predefiner](https://github.com/gavinggordon/predefiner) 

## Usage

### Installation

```shellscript
	composer require gavinggordon/constantgroups
```

### Examples

#### Instantiation:

```php
	include_once( __DIR__ . '/vendor/autoload.php' );
	
	$constantgroups = new \GGG\Config\ConstantGroups();
```

#### Setting:

Use as many or as few ConstantGroups as you want...
```php
	$constantgroups->set( ['hexcolours', 'rgbcolours', 'rgbacolours'] );
```

#### Initializing:

```php
	$constantgroups->init();
```

#### Utilization:

```php
	echo HEX_ORANGE;
	// Result:  #FF8000
```

```php
	echo RGB_ORANGE;
	// Result:  rgba( 255, 128, 0 )
```

```php
	echo RGBA_ORANGE;
	// Result:  rgba( 255, 128, 0, 1.0 )
```

#### More Capabilities:

Create your own named ConstantGroups...
```php
	use \GGG\Config\ConstantGroups as ConstantGroups;
	use \GGG\Config\ConstantGroupCreator as ConstantGroupCreator;
	
	$myconstantsgroup = [
		'my application name' => 'testapp',
		'application version' => '1.4.5',
		'apphomedir' => dirname( __DIR__ )
	];
	
	$constantgroupcreator = new ConstantGroupCreator( $myconstantsgroup );
	
	ConstantGroups::create( $constantgroupcreator, 'AppData' );
	
	$constantgroups = new ConstantGroups();
	
	$constantgroups->set( ['hexcolours', 'appdata'] );
	
	$constantgroups->init();
	
	echo MY_APPLICATION_NAME;
	// Result: testapp
```

#### Issues

If you have any issues at all, please post your findings in the issues page at [https://github.com/gavinggordon/constantgroups/issues](https://github.com/gavinggordon/constantgroups/issues).

#### License

This package utilizes the MIT License.