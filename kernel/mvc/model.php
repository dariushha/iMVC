<?php
namespace zinux\kernel\mvc;

require_once 'mvc.php';

/**
 * Description of model
 *
 * @author dariush
 */
class model extends mvc
{
    /**
     *
     * @var module
     */
    public $relative_module;
    
    public function Initiate(){}
    
    public function __construct($name, module $module, $auto_load = 1)
    {
        parent::__construct($name, $name);
        $this->relative_module = $module;
        $this->SetPath("{$this->relative_module->GetPath()}".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."{$this->full_name}{$this->extension}");
         if($auto_load)
             $this->Load();
    }

    public function GetNameSpace()
    {
        return $this->relative_module->GetNameSpace()."\\models";
    }
    
    public function CheckModelExists()
    {
        return class_exists($this->GetClassFullName());
    }
    
    public function GetClassFullName()
    {
        return $this->GetNameSpace()."\\".$this->full_name;
    }
    public function IsValid()
    {
        return ($this->CheckControllerExists() && $this->GetInstance() instanceof \zinux\kernel\controller\baseModel);
    }
    /**
     * 
     * @return \zinux\kernel\model\baseModel
     */
    public function GetInstance()
    {
        $c = $this->GetClassFullName();
        return new $c;
    }
}
