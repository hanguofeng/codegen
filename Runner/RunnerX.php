<?php
namespace Iefficiency\Codegen\Runner;

class RunnerX extends RunnerBase{
	
	protected function _run($generatorObj){
		$generatorObj->gen();
	}
	
}