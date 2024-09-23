<?
namespace Gke\Vehicle;

use Gke\Vehicle\VehicleColorTable;
use Gke\Vehicle\VehicleItemsTable;

class VehicleClass 
{

	public static function fillColor()
	{
		$arElements = [
			[
			"CODE" => "Black",
			"NAME" => "Black",
			],
			[
			"CODE" => "White",
			"NAME" => "White",
			],
			[
			"CODE" => "Silver",
			"NAME" => "Silver",
			],
			[
			"CODE" => "Graphite",
			"NAME" => "Graphite",
			],
		];
	
		foreach($arElements as $arRow )
		{
			$colorObj = VehicleColorTable::getEntity()->createObject();
			//$colorObj["CODE"] = $num+1;
			$colorObj["CODE"] = $arRow["CODE"];
			$colorObj["NAME"] = $arRow["NAME"];
	
			$saveResult = $colorObj->save();
		
			if(!$saveResult->isSuccess())
			{
				throw new \Exeption(implode(', ', $saveResult->getErrorMessage()));
			}
	
		}
	}



	public static function fillItems()
	{
		$arElements = [
			[
			 "VENDOR" => "ВАЗ",
			 "MODEL" => "210104",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2005','08','13'),
			 "CAPACITY" => "500",
			 "COLOR_ID" => "1",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "Ford",
			 "MODEL" => "Fusion",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2012','09','05','0','0','0'),
			 "CAPACITY" => "550",
			 "COLOR_ID" => "1",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "Audi",
			 "MODEL" => "A4",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2014','06','01','0','0','0'),
			 "CAPACITY" => "480",
			 "COLOR_ID" => "2",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "Audi",
			 "MODEL" => "A6",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2018','01','02','0','0','0'),
			 "CAPACITY" => "200",
			 "COLOR_ID" => "3",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "ГАЗ",
			 "MODEL" => "2410",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('1990','04','03','0','0','0'),
			 "CAPACITY" => "340",
			 "COLOR_ID" => "4",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "VW",
			 "MODEL" => "Transporter 3",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2003','02','07','0','0','0'),
			 "CAPACITY" => "1200",
			 "COLOR_ID" => "2",
			 "COMMERCIAL" => "Y",
			],
			[
			 "VENDOR" => "Nissan",
			 "MODEL" => "Rogue",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2017','08','10','0','0','0'),
			 "CAPACITY" => "600",
			 "COLOR_ID" => "3",
			 "COMMERCIAL" => "Y",
			],
			[
			 "VENDOR" => "Mercedes-Benz",
			 "MODEL" => "Vito 111",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2005','04','17','0','0','0'),
			 "CAPACITY" => "1350",
			 "COLOR_ID" => "1",
			 "COMMERCIAL" => "Y",
			],
			[
			 "VENDOR" => "Ford",
			 "MODEL" => "Focus",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2007','08','13','0','0','0'),
			 "CAPACITY" => "360",
			 "COLOR_ID" => "4",
			 "COMMERCIAL" => "N",
			],
			[
			 "VENDOR" => "ВАЗ",
			 "MODEL" => "210111",
			 "YEAR" => (new \Bitrix\Main\Type\DateTime())->setDate('2005','08','14','0','0','0'),
			 "CAPACITY" => "530",
			 "COLOR_ID" => "2",
			 "COMMERCIAL" => "N",
			],
		];
		foreach($arElements as $arRow )
		{
			$colorObj = VehicleItemsTable::getEntity()->createObject();
			$colorObj["VENDOR"] = $arRow["VENDOR"];
			$colorObj["MODEL"] = $arRow["MODEL"];
			$colorObj["YEAR"] = $arRow["YEAR"];
			$colorObj["CAPACITY"] = $arRow["CAPACITY"];
			$colorObj["COLOR_ID"] = $arRow["COLOR_ID"];
			$colorObj["COMMERCIAL"] = $arRow["COMMERCIAL"];
	
			$saveResult = $colorObj->save();
		
			if(!$saveResult->isSuccess())
			{
				throw new \Exeption(implode(', ', $saveResult->getErrorMessage()));
			}
		}
	}

}
?>