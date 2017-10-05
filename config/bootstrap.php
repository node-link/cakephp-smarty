<?php

use Cake\Core\Configure;

try{
    Configure::load('NodeLink/Smarty.app', 'default', false);
}catch (\Exception $e){
    exit($e->getMessage() . "\n");
}
