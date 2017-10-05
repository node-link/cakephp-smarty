<?php

namespace NodeLink\Smarty\View;

use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\View\View;
use Smarty;

class AppView extends View
{
    protected $_ext = '.tpl';
    protected $_smarty = null;

    public function __construct(
        Request $request = null,
        Response $response = null,
        EventManager $eventManager = null,
        array $viewOptions = []
    ){
        $this->_smarty = new Smarty();

        if (!file_exists(CACHE . 'smarty')) {
            mkdir(CACHE . 'smarty', 0777);
        }

        $debug = Configure::read('debug', false);

        $this->_smarty->setDebugging(Configure::read('Smarty.debugging', $debug));
        $this->_smarty->setAutoLiteral(Configure::read('Smarty.auto_literal', true));
        $this->_smarty->setEscapeHtml(Configure::read('Smarty.escape_html', false));
        $this->_smarty->setLeftDelimiter(Configure::read('Smarty.left_delimiter', '{'));
        $this->_smarty->setRightDelimiter(Configure::read('Smarty.right_delimiter', '}'));
        $this->_smarty->setErrorReporting(Configure::read('Smarty.error_reporting', null));
        $this->_smarty->setForceCompile(Configure::read('Smarty.force_compile', $debug));
        $this->_smarty->setCaching(Configure::read('Smarty.caching', false));
        $this->_smarty->setCacheLifetime(Configure::read('Smarty.cache_lifetime', 3600));
        $this->_smarty->setCompileCheck(Configure::read('Smarty.compile_check', true));
        $this->_smarty->setCompileDir(Configure::read('Smarty.compile_dir', CACHE . 'views'));
        $this->_smarty->setCacheDir(Configure::read('Smarty.cache_dir', CACHE . 'smarty'));
        $this->_smarty->setConfigDir(Configure::read('Smarty.config_dir', CONFIG . 'smarty'));
        $this->_smarty->setPluginsDir(Configure::read('Smarty.plugins_dir', CONFIG . 'smarty' . DS . 'plugins'));
        $this->_smarty->setTemplateDir(Configure::read('Smarty.template_dir', APP . 'Template'));
        $this->_smarty->setUseSubDirs(Configure::read('Smarty.use_sub_dirs', false));

        parent::__construct($request, $response, $eventManager, $viewOptions);
    }

    protected function _evaluate($viewFile, $dataForView)
    {
        foreach ($dataForView as $key => $val) {
            $this->_smarty->assign($key, $val);
        }
        $this->_smarty->assignByRef('this', $this);

        return $this->_smarty->fetch($viewFile);
    }
}
