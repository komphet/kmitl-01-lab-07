<?php
namespace Vender;
use Vender\Helper as Helper;

Class View extends Helper
{

	public function make($path,$data = []){
		if(count($data) != 0)
		{
			foreach ($data as $keyData => $valueData) {
				${$keyData} = $valueData;
			}
		}
		$path = 'View/'.join('/',explode('.', $path)).'.php';
		$page = file_get_contents($path);
		preg_match ('/(@extends\(.*\))/', $page,$extendsPath);
		$extendsPath = preg_replace('/@extends\(\'|\"|\'\)/', '', $extendsPath[0]);
		$extendsPath = 'View/'.join('/',explode('.', $extendsPath)).'.php';
		$extendsFile = file_get_contents($extendsPath);
		$html = $extendsFile;

		/**
		*	include
		**/
		preg_match_all ('/@include\(.*?\)/', $html,$includes);
		foreach ($includes as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$includeName = preg_replace('/@include\(\'|\"|\"|\'\)/','',$value2);
				$includePath = 'View/'.join('/',explode('.', $includeName)).'.php';
				$includedContent = file_get_contents($includePath);
				$html = preg_replace('/@include\(\'?\"?'.$includeName.'\'?\"?\)/', $includedContent, $html);
			}
		}

		/**
		*	yield
		**/
		preg_match_all('/@yield\(.*?\)/', $html,$yields);
		foreach ($yields as $yield) {
			foreach ($yield as $keyYield => $valueYield) {
				$yieldName = preg_replace('/@yield\(\'|\"|\"|\'\)/','',$valueYield);
				if(preg_match('/@section\(\'?\"?'.$yieldName.'\'?\"?\)/', $page))
				{
					preg_match_all('/@section\(\'?\"?'.$yieldName.'\'?\"?\).*?[\s\S]*?@endsection/', $page,$sections);
						foreach ($sections as $sectionKey => $sectionValue) {
							foreach ($sectionValue as $sectionKey2 => $sectionValue2) {
								$sctionContent[$sectionKey2] = trim(preg_replace('/@section\(\'?\"?'.$yieldName.'\'?\"?\)|@endsection/', '', $sectionValue2));

							}
						}
					$sctionContent = join(' ',$sctionContent);
					$html = preg_replace('/@yield\(\'?\"?'.$yieldName.'\'?\"?\)/', $sctionContent, $html);
					$sctionContent = null;
				}
			}
		}
		$html = preg_replace('/@yield\(.*\)/', '', $html);


		preg_match_all('/{{.*}}/', $html,$expre);
		foreach ($expre as $keyExpre => $valueExpre) {
			foreach ($valueExpre as $keyExpre2 => $valueExpre2) {
				$text = preg_replace('/{{|}}/', '', $valueExpre2);
				eval('$relace = '.$text.';');
				$html = str_replace($valueExpre2, $relace, $html);
			}
		}

		/**
		*	PHP Tag
		**/
		preg_match_all('/\<\?php.*?[\s\S]*?\?\>/', $html,$phpStr);
		foreach ($phpStr as $phpStrkey => $phpStrvalue) {
			foreach ($phpStrvalue as $phpStrkey2 => $phpStrvalue2) {
				$phpstrreplace = preg_replace('/\<\?php|\?\>/', '', $phpStrvalue2);
				$htmlExplode = explode($phpStrvalue2, $html);
				echo $htmlExplode[0];
				eval($phpstrreplace);
				$html = end($htmlExplode);
			}
		}

		echo ($html);

	}
}