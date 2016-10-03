<?php
namespace Vender;

Class View
{
	protected static function make($path){
		$path = 'View/'.join('/',explode('.', $path)).'.php';
		$page = file_get_contents($path);
		preg_match ('/(@extends\(.*\))/', $page,$extendsPath);
		$extendsPath = preg_replace('/@extends\(\'|\"|\'\)/', '', $extendsPath[0]);
		$extendsPath = 'View/'.join('/',explode('.', $extendsPath)).'.php';
		$extendsFile = file_get_contents($extendsPath);

		preg_match_all('/@yield\(.*?\)/', $extendsFile,$yields);
		$html = $extendsFile;
		foreach ($yields as $yield) {
			foreach ($yield as $keyYield => $valueYield) {
				$yieldName = preg_replace('/@yield\(\'|\"|\"|\'\)/','',$valueYield);
				preg_match_all('/@section\(.*'.$yieldName.'.*\).*?[\s\S]*?@endsection/', $page,$sections);
				foreach ($sections as $key => $value) {
					foreach ($value as $key2 => $value2) {
						$sctionContent[$key] = trim(preg_replace('/@section\(.*'.$yieldName.'.*\)|@endsection/', '', $value2));

					}
				}

				$sctionContent = join(' ',$sctionContent);
				$html = preg_replace('/@yield\(.*'.$yieldName.'.*\)/', $sctionContent, $html);
				$sctionContent = null;
			}
		}

		// preg_match_all ('/@include\(.*?\)/', $html,$includes);
		// foreach ($includes as $key => $value) {
		// 	foreach ($value as $key2 => $value2) {
		// 		$includeName = preg_replace('/@include\(\'|\"|\"|\'\)/','',$value2);
		// 		$includedContent = file_get_contents('View/'.$includeName.'.php');
		// 		$includeName = preg_replace('/@include\(\'|\"|\"|\'\)/','',$value2);
		// 		$html = preg_replace('/@include\(.*'.$includeName.'.*\)/', $includedContent, $html);
		// 	}
		// }
		//echo($yields);
		var_dump($includeName);
		// $html = preg_replace('', '', subject)
	}
}