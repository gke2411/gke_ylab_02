<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Bitrix\Main\Loader;
use Gke\Vehicle\VehicleClass;
use Gke\Vehicle\Iblock;

Loader::requireModule('iblock');
Loader::requireModule('gke.vehicle');

?>
<?
//заполнение таблицы цветов
//VehicleClass::fillColor();
//заполнение таблицы автомобилей
//VehicleClass::fillItems();
?>
<?
$APPLICATION->IncludeComponent(
	"gke:gkevehicle", 
	"gke_template", 
	array(
		"COMPONENT_TEMPLATE" => "gke_template",
		"IBLOCK_TYPE" => "gkevehicles",
		"IBLOCK_ID" => IBlock::GkeGetIBlockIDbyCode("gkevehicle"),
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "CODE",
			1 => "",
		),
		"IBLOCK_CODE" => "gkevehicle",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"FILTER_COLOR" => "",
		"FILTER_COMMERCIAL" => "",
		"FILTER_CAPACITY" => ""
	),
	false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>