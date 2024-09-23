<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Loader;
use Gke\Vehicle\VehicleClass;
use Gke\Vehicle\VehicleColorTable;
use Gke\Vehicle\VehicleItemsTable;

Loader::requireModule('iblock');
?>
<div>
	<div class="news-line">
		<h1>
		<?
		$APPLICATION->SetTitle(\CIBlock::GetList(Array(),Array("CODE"=> "gkevehicle"),false)->Fetch()['NAME']);
		?>
		</h1>
		<div>
			<div>Список доступных цветов: </div>
			<div>
			<?
			$colors = \Gke\Vehicle\VehicleColorTable::getList(
					[
						'select' => ['NAME'],
						'group' => ['NAME'],
						'data_doubling' => false,
					]
				)->fetchAll();
			$colorsList = "";
			foreach($colors as $color){$colorsList = $colorsList.$color['NAME'].", ";}
			?>
			<?=$colorsList?>
			</div>
		</div>
		<div>
			<table class="main-grid-table">
				<thead class="main-grid-header">
					<tr class="main-grid-row-head">
						<th class="main-grid-cell-head" scope="col">ID</th>
						<th class="main-grid-cell-head" scope="col">VENDOR</th>
						<th class="main-grid-cell-head" scope="col">MODEL</th>
						<th class="main-grid-cell-head" scope="col">YEAR</th>
						<th class="main-grid-cell-head" scope="col">CAPACITY</th>
						<th class="main-grid-cell-head" scope="col">COLOR</th>
						<th class="main-grid-cell-head" scope="col">COMMERCIAL</th>
					</tr>
				</thead>
				<tbody>
				<?
				foreach($arResult["ITEMS"] as $arItem)
				{
				?>
					<tr>
						<th scope="row"><?=$arItem['ID']?></th>
						<td><?=$arItem['VENDOR']?></td>
						<td><?=$arItem['MODEL']?></td>
						<td><?=$arItem['YEAR']?></td>
						<td><?=$arItem['CAPACITY']?></td>
						<td><?=$arItem['COLOR.NAME']?></td>
						<td><?=$arItem['COMMERCIAL']?></td>
					</tr>
				<?
				}
				?>
			</tbody>
			</table>
		</div>
	</div>
</div>