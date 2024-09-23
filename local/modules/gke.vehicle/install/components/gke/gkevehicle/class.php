<?php
use Bitrix\Main\Loader,
    Bitrix\Main,
    Bitrix\IBlock;

use Gke\Vehicle\VehicleClass;
use Gke\Vehicle\VehicleColorTable;
use Gke\Vehicle\VehicleItemsTable;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class GkeVehicleList extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{

		$arParams['FILTER_COMMERCIAL'] = ToUpper($arParams['FILTER_COMMERCIAL']);
		if($arParams['FILTER_COMMERCIAL'] <> 'Y' && $arParams['FILTER_COMMERCIAL'] <> 'N')
		{
			$arParams['FILTER_COMMERCIAL'] = "";
		}

		if(!is_numeric($arParams['FILTER_CAPACITY']))
		{
			$arParams['FILTER_CAPACITY'] = "";
		}

		return $arParams;
	}

	public function executeComponent()
	{
		$arParams = &$this->arParams;
		$arResult = &$this->arResult;
		$arResult = [
			'ITEMS' => [],
		];
	
		Loader::includeModule('iblock');
	
		if($this->startResultCache())
		{

			$select = ['ID', 'VENDOR', 'MODEL','YEAR','CAPACITY','COLOR.NAME','COMMERCIAL'];
			$order = ['ID' => 'ASC'];
			$filter = [];


			if($arParams['FILTER_COMMERCIAL'] <> "")
			{
				$filter[] = ['COMMERCIAL' => $arParams['FILTER_COMMERCIAL']];
			}

			if(is_numeric($arParams['FILTER_CAPACITY']))
			{
				$filter[] = ['CAPACITY' => $arParams['FILTER_CAPACITY']];
			}

			$dbItems = VehicleItemsTable::getList(
				[
					'select' => $select,
					'filter' => $filter,
					'order'  => $order,
				]
			);

			$arResult = [];
			while($arItem = $dbItems->Fetch()){
				$arResult['ITEMS'][] = $arItem;
			};

				//$arResult['ITEMS']['SELECT'][] = $select;
				//$arResult['ITEMS']['ORDER'][] = $order;
				//$arResult['ITEMS']['FILTER'][] = $filter;

			$this->includeComponentTemplate();
		}
		else {
			$this->abortResultCache();
		}
	}
}