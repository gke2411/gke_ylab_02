<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

?>
<div class="news-line">
<?
//$r = gkeAccessDisableElement();
//var_dump($r);
?>
	<table class="main-grid-table">
		<thead class="main-grid-header">
			<tr class="main-grid-row-head">
				<th class="main-grid-cell-head" scope="col">#</th>
				<th class="main-grid-cell-head" scope="col"><?=Loc::getMessage("GKE_ACCESS_LIST_TABLE_COLUMN_NAME")?></th>
				<th class="main-grid-cell-head" scope="col"><?=Loc::getMessage("GKE_ACCESS_LIST_TABLE_COLUMN_DATE_FROM")?></th>
				<th class="main-grid-cell-head" scope="col"><?=Loc::getMessage("GKE_ACCESS_LIST_TABLE_COLUMN_DATE_TO")?></th>
				<th class="main-grid-cell-head" scope="col"><?=Loc::getMessage("GKE_ACCESS_LIST_TABLE_COLUMN_IS_ACTIVE")?></th>
				<th class="main-grid-cell-head" scope="col"><?=Loc::getMessage("GKE_ACCESS_LIST_TABLE_COLUMN_CODE")?></th>
			</tr>
		</thead>
		<tbody>
		<?
		$iiiiii = 1;
		foreach($arResult["ITEMS"] as $arItem):
					if($arItem['ACTIVE'] == $arParams['ACTIVE']) {
		?>
					<tr>
						<th scope="row"><?=$iiiiii?></th>
						<td><?=$arItem['NAME']?></td>
						<td><?echo ConvertDateTime($arItem['DATE_ACTIVE_FROM'], "YYYY-MM-DD", "ru")?></td>
						<td><?echo ConvertDateTime($arItem['DATE_ACTIVE_TO'], "YYYY-MM-DD", "ru")?></td>
						<td><?=$arItem['ACTIVE']?></td>
						<td><?=$arItem['CODE']?></td>
					</tr>
					<?$iiiiii++;
					}
					?>
		<?endforeach;?>
  	</tbody>
	</table>
</div>
