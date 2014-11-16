<?php
namespace Iefficiency\Codegen\Runner;

abstract class RunnerBase{
	public function run($generator,$params){
		$generatorObj = $this->preRun($generator,$params);
		
		if($generatorObj){
			$this->_run($generatorObj);
		}else{
			print('[FATAL]Generator:#'.$generator.'# not found!');
		}
		
		$this->postRun($generatorObj,$params);
	}
	
	protected function preRun($generator,$params){
		$className = '\\Iefficiency\\Codegen\\Generator\\'.$generator."Generator";
		if(class_exists($className)){
			return new $className($params);
		}else{
			return null;
		}
	}
	protected abstract function _run($params);
	protected function postRun($generator,$params){}

}