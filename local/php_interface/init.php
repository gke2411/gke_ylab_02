<?
function gkeAccessUniqueCode($iblockid = 0){
	$text = "";
	if($iblockid > 0)
	{
		$elementCodeSet = false; 
		$dbItems = [];
		while (!$elementCodeSet) 
		{
			$text = randString(6, array(
					"abcdefghijklnmopqrstuvwxyz",
					"ABCDEFGHIJKLNMOPQRSTUVWXYZ",
					"0123456789",
					//"!@#\$%^&*()",
			));

			$dbItems = CIBlockElement::GetList(
				[],
				[
				 'IBLOCK_ID' => $gkeIBlockID,
				 'CODE' => $text,
				],
				false,
				false,
				[
				 'IBLOCK_ID',
				 'ID',
				 'CODE'
				]
			);

			$arResult = [];
			while($arItem = $dbItems->Fetch()){
				$arResult[] = $arItem;
			};

			if($arResult == []) {
				$elementCodeSet = true;
			}
		}
	}
	return $text;
}

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandlerCompatible("iblock", "OnBeforeIBlockElementAdd", "GkeOnBeforeIBlockElementAddHandler");

function GkeOnBeforeIBlockElementAddHandler(&$arFields)
	{
		$gkeIBlockID = (\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['ID']);
		if($arFields["IBLOCK_ID"] == $gkeIBlockID)
		{
			if(!$arFields["ACTIVE_FROM"])
			{
				$arFields["ACTIVE_FROM"] = date('d.m.Y H:i:s');
			}
			if(!$arFields["ACTIVE_TO"])
			{
				$arFields["ACTIVE_TO"] = ConvertTimeStamp((AddToTimeStamp(array("DD" => +7) ,MakeTimeStamp($arFields["ACTIVE_FROM"]))), "FULL", 'ru');
			}

			$arFields["CODE"] =gkeAccessUniqueCode($gkeIBlockID); 
		}
	}

function GkeOnBeforeIBlockElementUpdateHandler(&$arFields)
{
	$gkeIBlockID = (\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['ID']);
	if($arFields["IBLOCK_ID"] == $gkeIBlockID)
	{
		$arFields["CODE"] =gkeAccessUniqueCode($gkeIBlockID);
	}
}


//Agent
function gkeAccessDisableElement()
{
	global $DB;
	
	$timer = date('d.m.Y H:i:s');

	$gkeIBlockID = (\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['ID']);

	$arFields["CODE"] =gkeAccessUniqueCode($gkeIBlockID); 

	$dbItems = [];
	$dbItems = \CIBlockElement::GetList(
		[],
		[
		 'IBLOCK_ID' => $gkeIBlockID,
		 'ACTIVE' => 'Y',
		],
		false,
		false,
		[
		 'IBLOCK_ID',
		 'ID',
		 'CODE',
		 'NAME',
		 'DATE_ACTIVE_FROM',
		 'DATE_ACTIVE_TO',
		 'ACTIVE',
		]
	);

	$arResult = [];
	$arElementIDList = "";
	$iii = 0;
	while($arItem = $dbItems->Fetch()){
		if($DB->CompareDates($arItem['DATE_ACTIVE_TO'], $timer) == -1){
			$arResult[] = $arItem;
			$arElementIDList = $arElementIDList.$arItem['ID'].", ";
			$el = new CIBlockElement;
			$el->Update(
				$arItem['ID'],
				[
					'ACTIVE' => 'N',
				],
				false,
				true,
				false,
				true
			);
			$iii++;
		}
	};
	/*
	//$filePath = $_SERVER['DOCUMENT_ROOT'].'/local/gkeagent.txt';
	$rs = fopen($filePath, "a+");
	if($rs){
		fwrite($rs, $timer." gke agent start"."\n");
		fwrite($rs, $timer." gke IBlockID: ".$gkeIBlockID.", количество элеменов : ".$iii."\n");
		fwrite($rs, $timer." gke list of disabled elements: ".$arElementIDList."\n");
		fwrite($rs, $timer." gke agent end"."\n");
		fclose($rs);
	}*/

	return __METHOD__ . '();';
}
?>