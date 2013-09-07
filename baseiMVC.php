<?php
namespace iMVC;

if(!defined("iMVC_INCLUDE_PATH_SET"))
{
    define("iMVC_INCLUDE_PATH_SET",1);
    ini_set('include_path', implode(PATH_SEPARATOR, array(ini_get('include_path'),  realpath(dirname(__FILE__)))));
    define("iMVC_ROOT", dirname(__FILE__)."/");
}

if(!defined("IMVC_AUTOLOAD"))
{
    define("IMVC_AUTOLOAD", 1);
    spl_autoload_register(
        function ($class) {
            if(strpos($class, "iMVC")===false) return;
            $r = explode("\\", $class);
            unset($r[0]);
            $c = implode(DIRECTORY_SEPARATOR, $r);
            require_once iMVC_ROOT.'kernel/utilities/fileSystem.php';
            require_once kernel\utilities\fileSystem::resolve_path(iMVC_ROOT."$c.php");
        },1,1);
}

/**
 * This is a base class for all iMVC classes
 * @author dariush
 * @version 1.0
 * @created 04-Sep-2013 15:50:21
 */
abstract class baseiMVC extends \stdClass
{
	function __construct()
	{
	}

	function __destruct()
	{
	}

	/**
	 * This will dispose any temp attributes which added by __set()
	 */
	public function Dispose()
	{
            foreach($this as $key => $value)
            {
                unset($this->$key);
                unset($value);
            }
	}

	/**
	 * The initiation works on loading class
	 */
	abstract public function Initiate();
}
?>
