<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
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
				<th class="main-grid-cell-head" scope="col">NAME</th>
				<th class="main-grid-cell-head" scope="col">DATE_ACTIVE_FROM</th>
				<th class="main-grid-cell-head" scope="col">DATE_ACTIVE_TO</th>
				<th class="main-grid-cell-head" scope="col">IS_ACTIVE</th>
				<th class="main-grid-cell-head" scope="col">CODE</th>
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
