<?
use Bitrix\Main\Loader,
	Bitrix\Main\Entity\Base,
	Bitrix\Main\ModuleManager,
	Bitrix\Main\Localization\Loc;

use Bitrix\Main\Application;
use Gke\Vehicle\VehicleColorTable;
use Gke\Vehicle\VehicleItemsTable;

Loc::loadMessages(__FILE__);

Class gke_vehicle extends CModule
{
    public $MODULE_ID = "gke.vehicle";
	public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

	function __construct()
	{
		$this->MODULE_NAME = Loc::getMessage("GKE_VEHICLE_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("GKE_VEHICLE_MODULE_DESCRIPTION");
		$this->PARTNER_NAME = Loc::getMessage("GKE_VEHICLE_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("GKE_VEHICLE_PARTNER_URI");
		/*
		$arModuleVersion = array();
		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));

		include($path."/version.php");
		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}
		*/
	}

	function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/gke.vehicle/install/components",
				 	$_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
		return true;
	}

	function InstallEvents(){
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->registerEventHandlerCompatible('main', 'OnBeforeProlog', $this->MODULE_ID); 
	}

	function InstallDB()
	{
		Loader::includeModule($this->MODULE_ID);

		$connection = Application::getConnection(); 
		if(!$connection->isTableExists(VehicleColorTable::getTableName()))
		{
			VehicleColorTable::getEntity()->createDbTable();
		}

		if(!$connection->isTableExists(VehicleItemsTable::getTableName()))
		{
			VehicleItemsTable::getEntity()->createDbTable();
		}
	}

	function UnInstallFiles()
	{
		DeleteDirFilesEx("/local/components/gke");
		return true;
	}

	function UnInstallEvents(){
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->unRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
	}

	function UnInstallDB()
	{
		Loader::includeModule($this->MODULE_ID);

		$connection = Application::getConnection(); 
		if (Application::getConnection()->isTableExists(Base::getInstance('\Gke\Vehicle\VehicleColorTable')->getDBTableName())) {
			$connection = Application::getInstance()->getConnection();
			$connection->dropTable(VehicleColorTable::getTableName());
		}
		
		if (Application::getConnection()->isTableExists(Base::getInstance('\Gke\Vehicle\VehicleItemsTable')->getDBTableName())) {
			$connection = Application::getInstance()->getConnection();
			$connection->dropTable(VehicleItemsTable::getTableName());
		}

	}

	function DoInstall()
	{
		global $DOCUMENT_ROOT, $APPLICATION;
		RegisterModule("gke.vehicle");
		$this->InstallFiles();
		$this->InstallEvents();
		$this->InstallDB();
		$APPLICATION->IncludeAdminFile("Установка модуля gke.vehicle", $DOCUMENT_ROOT."/local/modules/gke.vehicle/install/step.php");
	}

	function DoUninstall()
	{
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();
		UnRegisterModule("gke.vehicle");
		$APPLICATION->IncludeAdminFile("Деинсталляция модуля gke.vehicle", $DOCUMENT_ROOT."/local/modules/gke.vehicle/install/unstep.php");
	}
}
?>