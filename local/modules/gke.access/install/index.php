<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

Class gke_access extends CModule
{
    public $MODULE_ID = "gke.access";
	public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

	function __construct()
	{
		$this->MODULE_NAME = Loc::getMessage("GKE_ACCESS_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("GKE_ACCESS_MODULE_DESCRIPTION");
		$this->PARTNER_NAME = Loc::getMessage("GKE_ACCESS_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("GKE_ACCESS_PARTNER_URI");
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
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/gke.access/install/components",
				 	$_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		return true;
	}

	function InstallEvents(){
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->registerEventHandlerCompatible('main', 'OnBeforeProlog', $this->MODULE_ID); 

		$eventManager->registerEventHandlerCompatible('iblock', 'OnBeforeIBlockElementAdd', $this->MODULE_ID, "Gke\Access\AccessClass", "GkeOnBeforeIBlockElementAddHandler" );
		$eventManager->registerEventHandlerCompatible('iblock', 'OnBeforeIBlockElementUpdate', $this->MODULE_ID, "Gke\Access\AccessClass", "GkeOnBeforeIBlockElementUpdateHandler" );
	}
	
	function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/components/gke");
		return true;
	}

	function UnInstallEvents(){
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->unRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);

		$eventManager->unRegisterEventHandler('iblock', '\Bitrix\Iblock\Iblock::OnBeforeIBlockElementAdd', $this->MODULE_ID, 'Gke\Access\AccessClass', 'GkeOnBeforeIBlockElementAddHandler' );
		$eventManager->unRegisterEventHandler('iblock', '\Bitrix\Iblock\Iblock::OnBeforeIBlockElementUpdate', $this->MODULE_ID, 'Gke\Access\AccessClass', 'GkeOnBeforeIBlockElementUpdateHandler' );
	}

	function DoInstall()
	{
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->InstallFiles();
		$this->InstallEvents();
		RegisterModule("gke.access");
		$APPLICATION->IncludeAdminFile("Установка модуля gke.access", $DOCUMENT_ROOT."/local/modules/gke.access/install/step.php");
	}

	function DoUninstall()
	{
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->UnInstallFiles();
		$this->UnInstallEvents();
		UnRegisterModule("gke.access");
		$APPLICATION->IncludeAdminFile("Деинсталляция модуля gke.access", $DOCUMENT_ROOT."/local/modules/gke.access/install/unstep.php");
	}
}
?>