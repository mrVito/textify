<?php namespace MrVito\Textify\en_US;

use MrVito\Textify\NumberToText as BaseNumberToText;

class NumberToText extends BaseNumberToText
{

	protected function getUpToTwentyNames()
	{
		return [
			'zero',
			'one',
			'two',
			'three',
			'four',
			'five',
			'six',
			'seven',
			'eight',
			'nine',
			'ten',
			'eleven',
			'twelve',
			'thirteen',
			'fourteen',
			'fifteen',
			'sixteen',
			'seventeen',
			'eighteen',
			'nineteen'
		];
	}

	protected function getTwoDigitNames()
	{
		return [
			'twenty',
			'thirty',
			'forty',
			'fifty',
			'sixty',
			'seventy',
			'eighty',
			'ninety'
		];
	}

	protected function getThreeDigitNames()
	{
		return [
			'one hundred',
			'two hundred',
			'three hundred',
			'four hundred',
			'five hundred',
			'six hundred',
			'seven hundred',
			'eight hundred',
			'nine hundred'
		];
	}

	protected function getPostfixNames()
	{
		return [
			['thousand', '', '', ''],
			['million', '', '', ''],
			['billion', '', '', ''],
			['trillion', '', '', ''],
			['quadrillion', '', '', ''],
			['quintillion', '', '', ''],
			['sextillion', '', '', ''],
			['septillion', '', '', ''],
		];
	}

	protected function getHundredsAndTensSeparator()
	{
		return 'and';
	}

	protected function getNumberGroupsSeparator()
	{
		return ',';
	}

	protected function getCurrencyNames()
	{
		return [
			'whole' => ['dollar', '', 's', 's'],
			'cents' => ['cent', '', 's', 's']
		];
	}

	protected function getCurrencyCombiner()
	{
		return 'and';
	}
}

