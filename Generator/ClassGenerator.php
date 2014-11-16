<?php
namespace Iefficiency\Codegen\Generator;

class ClassGenerator extends GeneratorBase{
	
	public function gen(){
		$className = $this->params['name'];
		$className = ucfirst($className);
		$smarty = $this->getSmarty();
		$smarty->assign('className',$className);
		$content = $smarty->fetch($this->getDefaultTplFull());
		$fileName = "$className.class.php";
		$fileArray = array(
				array(
						'name'=>$fileName,
						'content'=>$content
				)
		);
		
		$this->output($fileArray);
	}
}