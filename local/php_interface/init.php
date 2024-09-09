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


AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("GkeAccessAddClass", "OnBeforeIBlockElementAddHandler"));

class GkeAccessAddClass
{
	public static function OnBeforeIBlockElementAddHandler(&$arFields)
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
			/*
			$elementCodeSet = false; 
			$dbItems = [];
			while (!$elementCodeSet) 
			{
				$elementCodeRandString = randString(6, array(
						"abcdefghijklnmopqrstuvwxyz",
						"ABCDEFGHIJKLNMOPQRSTUVWXYZ",
						"0123456789",
						//"!@#\$%^&*()",
				));

				$dbItems = CIBlockElement::GetList(
					[],
					[
					 'IBLOCK_ID' => $gkeIBlockID,
					 'CODE' => $elementCodeRandString,
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
				//AddMessage2Log("Запись с кодом: ".$arFields["CODE"]." - проверена.");
				if($arResult == []) {
					$arFields["CODE"] = $elementCodeRandString;
					$elementCodeSet = true;
					//AddMessage2Log("Запись с кодом: ".$arFields["CODE"]." - установлена.");
				}
			}
			*/
			$arFields["CODE"] =gkeAccessUniqueCode($gkeIBlockID); 
		}
	}
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("GkeAccessUpdateClass", "OnBeforeIBlockElementUpdateHandler"));
class GkeAccessUpdateClass
{
	public static function OnBeforeIBlockElementUpdateHandler(&$arFields)
	{
		$gkeIBlockID = (\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['ID']);
		if($arFields["IBLOCK_ID"] == $gkeIBlockID)
		{
			$arFields["CODE"] =gkeAccessUniqueCode($gkeIBlockID);
		}
	}
}

//Agent
function gkeAccessDisableElement()
{
	global $DB;
	
	$timer = date('d.m.Y H:i:s');
	//$filePath = $_SERVER['DOCUMENT_ROOT'].'/local/gkeagent.txt';

	$gkeIBlockID = (\CIBlock::GetList(Array(),Array("CODE"=> "gkeaccessmgmt"),false)->Fetch()['ID']);

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