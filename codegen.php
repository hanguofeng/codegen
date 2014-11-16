<?php
namespace Iefficiency\Codegen;

require_once (dirname(__FILE__) . '/./Lib/Autoloader.php');
define('ROOT_PATH',dirname(__FILE__));
define('_CODEGEN_SMARTY_PATH' , ROOT_PATH . "/Lib/smarty/");
define('_CODEGEN_SMARTY_TEMPLATE_PATH' , ROOT_PATH . "/template/template/");
define('_CODEGEN_SMARTY_CACHE_PATH' , ROOT_PATH . "/template/cache/");
define('_CODEGEN_SMARTY_COMPILE_PATH',ROOT_PATH . "/template/template_c/");
define('_CODEGEN_SMARTY_CONFIG_PATH',ROOT_PATH . "/template/config/");
define('_CODEGEN_SMARTY_LEFT_DELIMITER','<{');
define('_CODEGEN_SMARTY_RIGHT_DELIMITER','}>');

$loader = new \Iefficiency\Lib\Autoloader();
$loader->register();
$loader->addNamespace('Iefficiency\Codegen',dirname(__FILE__));

$args = \Iefficiency\Codegen\Lib\CommandLine::parseArgs($_SERVER['argv']);

if(!is_array($args) || count($args)<1 || !array_key_exists("gen", $args)){
	useage();
	exit(0);
}

$generator = $args['gen'];
$r = new \Iefficiency\Codegen\Runner\RunnerX();
$r->run($generator,$args);


function useage(){
	print "#################################\n";
	print "#\tthe php code generator\t#\n";
	print "#################################\n";
	
	print "useage: php " . pathinfo(__FILE__,PATHINFO_BASENAME) ." --gen=<generator> -xxx(generator parameters)" . "\n";
}