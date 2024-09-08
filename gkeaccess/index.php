<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$APPLICATION->SetTitle(\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['NAME']);
?>
<?$APPLICATION->IncludeComponent(
	"gke:gkeaccess.list", 
	"gke_template", 
	array(
		"COMPONENT_TEMPLATE" => "gke_template",
		"IBLOCK_TYPE" => "gkeaccess",
		"IBLOCK_ID" => \CIBlock::GetList(Array(),Array("CODE"=>"gkeaccessmgmt"),false)->Fetch()["ID"],
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "CODE",
			1 => "DATE_ACTIVE_FROM",
			2 => "DATE_ACTIVE_TO",
			3 => "",
		),
		"IBLOCK_CODE" => "gkeaccessmgmt",
		"ACTIVE" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300"
	),
	false
);?>
<?
//
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>