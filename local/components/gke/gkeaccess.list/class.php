<?php
use Bitrix\Main\Loader,
    Bitrix\Main,
    Bitrix\IBlock;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class GkeAccessList extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		$arParams['ACTIVE'] = ToUpper($arParams['ACTIVE']);
		if($arParams['ACTIVE'] <> 'Y' && $arParams['ACTIVE'] <> 'N')
		{
			$arParams['ACTIVE'] = 'Y';
		}
		return $arParams;
	}

	public function executeComponent()
	{
		$arParams = &$this->arParams;
		$arResult = &$this->arResult;
		$arResult = [
		    'ITEMS' => []
		];
	
		Loader::includeModule('iblock');
	
		if($this->startResultCache())
		{
			$dbItems = CIBlockElement::GetList(
				[],
				[
				 'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
				 'ACTIVE' => $arParams['ACTIVE']
				],
				false,
				false,
				[
				 'IBLOCK_ID',
				 'ID',
				 'NAME',
				 'CODE',
				 'DATE_ACTIVE_FROM',
				 'DATE_ACTIVE_TO',
				 'ACTIVE'
				]
			);
		
			$arResult = [];
			while($arItem = $dbItems->Fetch()){
				$arResult['ITEMS'][] = $arItem;
			};
			$this->includeComponentTemplate();
		}
		else {
			$this->abortResultCache();
		}
	}
}