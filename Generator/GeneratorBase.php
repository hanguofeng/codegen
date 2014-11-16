<?php

namespace Iefficiency\Codegen\Generator;

abstract class GeneratorBase {
	protected $gen = '';
	protected $dest = '';
	protected $params;
	protected $smarty;
	public function __construct($params) {
		$this->gen = $params ['gen'];
		unset ( $params ['gen'] );
		$this->dest = $params ['dest'];
		unset ( $params ['dest'] );
		$this->params = $params;
	}
	abstract public function gen();
	protected function getSmarty() {
		require_once _CODEGEN_SMARTY_PATH . '/Smarty.class.php';
		$smarty = new \Smarty ();
		$this->smarty = $smarty;
		$this->smarty->setCacheDir ( _CODEGEN_SMARTY_CACHE_PATH );
		$this->smarty->setCompileDir ( _CODEGEN_SMARTY_COMPILE_PATH );
		$this->smarty->setTemplateDir ( _CODEGEN_SMARTY_TEMPLATE_PATH );
		$this->smarty->setLeftDelimiter ( _CODEGEN_SMARTY_LEFT_DELIMITER );
		$this->smarty->setRightDelimiter ( _CODEGEN_SMARTY_RIGHT_DELIMITER );
		$this->smarty->setConfigDir ( _CODEGEN_SMARTY_CONFIG_PATH );
		$this->smarty->caching = false;
		
		return $this->smarty;
	}
	protected function getDefaultTplDir() {
		return $this->gen . DIRECTORY_SEPARATOR;
	}
	protected function getDefaultTplFull() {
		return $this->getDefaultTplDir () . "default.tpl";
	}
	protected function output($fileArray) {
		
		if (!is_dir( $this->dest )) {
			if (! empty ( $this->dest )) {
				mkdir ( $this->dest );
			}
			if (! is_dir ( $this->dest )) {
				foreach ( $fileArray as $ele ) {
					$fileName = $ele ['name'];
					$fileContent = $ele ['content'];
					
					print "\nFILE:$fileName\n";
					print "$fileContent";
					print "\n";
				}
				
				return;
			}
		}
		
		foreach ( $fileArray as $ele ) {
			$fileName = $ele ['name'];
			$fileContent = $ele ['content'];
			
			file_put_contents ( $this->dest . DIRECTORY_SEPARATOR . $fileName, $fileContent );
		}
	}
}