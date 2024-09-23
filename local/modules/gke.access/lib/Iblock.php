<?
namespace Gke\Access;
//IBlock
class Iblock
{
	public static function gkeGetIBlockIDbyCode($IBlockCode)
	{
		$id = 0;
		if(trim($IBlockCode) <> "")
		{
			$id = (\CIBlock::GetList(Array(),Array("CODE"=> $IBlockCode),false)->Fetch()['ID']);
		}
		return $id;
	}

}

?>