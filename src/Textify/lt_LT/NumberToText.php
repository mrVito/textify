<?php namespace MrVito\Textify\NumberToText\LT_LT;

use MrVito\Textify\NumberToText\NumberToText as BaseNumberToText;

class NumberToText extends BaseNumberToText
{

	protected function getUpToTwentyNames()
	{
		return [
			'nulis',
			'vienas',
			'du',
			'trys',
			'keturi',
			'penki',
			'šeši',
			'septyni',
			'aštuoni',
			'devyni',
			'dešimt',
			'vienuolika',
			'dvylika',
			'trylika',
			'keturiolika',
			'penkiolika',
			'šešiolika',
			'septyniolika',
			'aštuoniolika',
			'devyniolika'
		];
	}

	protected function getTwoDigitNames()
	{
		return [
			'dvidešimt',
			'trisdešimt',
			'keturiasdešimt',
			'penkiasdešimt',
			'šešiasdešimt',
			'septyniasdešimt',
			'aštuoniasdešimt',
			'devyniasdešimt'
		];
	}

	protected function getThreeDigitNames()
	{
		return [
			'vienas šimtas',
			'du šimtai',
			'trys šimtai',
			'keturi šimtai',
			'penki šimtai',
			'šeši šimtai',
			'septyni šimtai',
			'aštuoni šimtai',
			'devyni šimtai'
		];
	}

	protected function getPostfixNames()
	{
		return [
			['tūkstan', 'tis', 'čiai', 'čių'],
			['milijon', 'as', 'ai', 'ų'],
			['milijard', 'as', 'ai', 'ų'],
			['trilijon', 'as', 'ai', 'ų'],
			['kvadralijon', 'as', 'ai', 'ų'],
			['kvintilijon', 'as', 'ai', 'ų'],
			['sikstilijon', 'as', 'ai', 'ų'],
			['oktalijon', 'as', 'ai', 'ų'],
		];
	}

	protected function getCurrencyNames()
	{
		return [
			'whole' => ['eur', 'as', 'ai', 'ų'],
			'cents' => ['cent', 'as', 'ai', 'ų']
		];
	}

	protected function getCurrencyCombiner()
	{
		return 'ir';
	}
}

