# Smarty plugin for CakePHP

The Smarty plugin is a simple way to install Smarty view on your CakePHP 3 application with 3 steps.

## Requirements

* CakePHP 3.x
* PHP 5.5+

## Installation

### 1. Install plugin

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require node-link/cakephp-smarty
```

### 2. Load plugin

Use `bin/cake` to load the plugin as follows:

```bash
bin/cake plugin load NodeLink/Smarty
```

Or, manually add the following to `config/bootstrap.php`:

```php
<?php
use Cake\Core\Plugin;

Plugin::load('NodeLink/Smarty');
```

### 3. Set View class

In the `AppController.php` of your application, specify the View class.

```php
<?php
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->setClassName('NodeLink/Smarty.App');

        // Prior to CakePHP 3.4.0
        $this->viewBuilder()->className('NodeLink/Smarty.App');
    }
}
```

## Configuration

If you want to change Smarty's behavior, you can change Smarty's behavior by writing `config/app.php` as follows.

```php
<?php
return [
    // Add the following
    'Smarty' => [
        'debugging' => true,                            // Default: Configure::read('debug')
        'auto_literal' => true,                         // Default: true
        'escape_html' => true,                          // Default: false
        'left_delimiter' => '<!--{',                    // Default: '{'
        'right_delimiter' => '}-->',                    // Default: '}'
        'error_reporting' => E_ALL & ~E_NOTICE,         // Default: null
        'force_compile' => true,                        // Default: Configure::read('debug')
        'caching' => Smarty::CACHING_LIFETIME_CURRENT,  // Default: false
        'cache_lifetime' => 86400,                      // Default: 3600
        'compile_check' => true,                        // Default: true
        'compile_dir' => null,                          // Default: CACHE . 'views'
        'cache_dir' => null,                            // Default: CACHE . 'smarty'
        'config_dir' => null,                           // Default: CONFIG . 'smarty'
        'plugins_dir' => null,                          // Default: CONFIG . 'smarty' . DS . 'plugins'
        'template_dir' => null,                         // Default: APP . 'Template'
        'use_sub_dirs' => false,                        // Default: false
    ],
];
```

If the setting item is not filled out or null is set, the default value is used.

If you want to define plugins such as functions and modifiers, `config/smarty/plugins` is the plugins directory by default, so place the plugins in `config/smarty/plugins`.

## Reporting Issues

If you have a problem with the Smarty plugin, please send a pull request or open an issue on [GitHub](https://github.com/node-link/cakephp-smarty/issues).
