<?php
require_once ('..\..\BaseiMVC.php');

namespace iMVC\kernel\application;


/**
 * @author dariush
 * @version 1.0
 * @created 04-Sep-2013 15:35:06
 */
class application extends BaseiMVC
{

	function __construct()
	{
	}

	function __destruct()
	{
	}



	/**
	 * Run the application
	 */
	public function Run()
	{
	}

	/**
	 * Shutdowns application
	 */
	public function Shutdown()
	{
	}

	/**
	 * Startup and making application's ready with passed configuration file
	 * 
	 * @param config_file_address
	 */
	public function Startup(string $config_file_address = "")
	{
	}

}
?>