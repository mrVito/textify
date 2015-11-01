<?php namespace MrVito\Textify\NumberToText;

abstract class NumberToText
{
	protected $upToTwentyNames;
	protected $twoDigitNames;
	protected $threeDigitNames;
	protected $postfixNames;
	protected $currencyNames;
	protected $currencyCombiner;

	/**
	 * @var static|null
	 */
	protected static $instance = null;

	public static function create()
	{
		if(static::$instance !== null) {
			return static::$instance;
		}

		static::$instance = new static();

		static::$instance->setUpToTwentyNames();
		static::$instance->setTwoDigitNames();
		static::$instance->setThreeDigitNames();
		static::$instance->setPostfixNames();
		static::$instance->setCurrencyNames();
		static::$instance->setCurrencyCombiner();

		return static::$instance;
	}

	/**
	 * This function must return an array with names of numbers from 0 to 19
	 * @return array
	 */
	protected abstract function getUpToTwentyNames();

	/**
	 * This function must return an array with names of whole two digit numbers from 20 to 90
	 * i.e. ['twenty', 'thirty', 'forty', ...]
	 * @return array
	 */
	protected abstract function getTwoDigitNames();

	/**
	 * This function must return an array with names of whole three digit numbers from 100 to 900
	 * i.e. ['one hundred', 'two hundred', 'three hundred', ...]
	 * @return array
	 */
	protected abstract function getThreeDigitNames();

	/**
	 * This function must return an array of arrays with names of number
	 * postfixes starting at thousands in the following format:<br/>
	 * [word_root, ending_for_single, ending_for_multiple, ending_for_genitive]<br/>
	 * i.e.:<br/>
	 * <pre>
	 * [
	 *    ['t?kstan', 'tis', '?iai', '?i?'],
	 *    ['milijon', 'as', 'ai', '?'],
	 *    [...],
	 * ]
	 * </pre>
	 * @return array
	 */
	protected abstract function getPostfixNames();

	/**
	 * This function must return an array of currency names in the following format:
	 * <pre>
	 * [
	 *    'whole' => ['word_root', 'ending_for_single', 'ending_for_multiple', 'ending_for_genitive'],
	 *    'cents' => ['word_root', 'ending_for_single', 'ending_for_multiple', 'ending_for_genitive']
	 * ]
	 * </pre>
	 * i.e.:
	 * <pre>
	 * [
	 *    'whole' => ['eur', 'as', 'ai', '?'],
	 *    'cents' => ['cent', 'as', 'ai', '?']
	 * ]
	 * </pre>
	 * @return array
	 */
	protected abstract function getCurrencyNames();

	/**
	 * This function must return a string to concatenate whole and cents portion of money string
	 * i.e. if "and" is returned, then returned money strings might look something like this:
	 * "one hundred sixty nine eur <b>and</b> twenty seven cents"
	 * @return string
	 */
	protected abstract function getCurrencyCombiner();

	protected function setUpToTwentyNames()
	{
		$upToTwentyNames = $this->getUpToTwentyNames();

		$this->upToTwentyNames = $upToTwentyNames;
	}

	protected function setTwoDigitNames()
	{
		$twoDigitNames = $this->getTwoDigitNames();

		$this->twoDigitNames = array_merge([null, null], $twoDigitNames);
	}

	protected function setThreeDigitNames()
	{
		$threeDigitNames = $this->getThreeDigitNames();

		$this->threeDigitNames = array_merge([null], $threeDigitNames);
	}

	protected function setPostfixNames()
	{
		$postfixNames = $this->getPostfixNames();

		$this->postfixNames = array_merge([null], $postfixNames);
	}

	protected function setCurrencyNames()
	{
		$this->currencyNames = $this->getCurrencyNames();
	}

	protected function setCurrencyCombiner()
	{
		$this->currencyCombiner = $this->getCurrencyCombiner();
	}

	public function getText($number)
	{
		$numberString = '';

		$strNumber = (string) $number;
		$numOfDigits = strlen($strNumber);
		$iterations = ceil($numOfDigits / 3);

		for ($i = 0; $i < $iterations; $i++)
		{
			$portion = strrev(substr(strrev($strNumber), $i * 3, 3));

			$digits = str_split($portion);

			$portionString = '';

			foreach($digits as $key => $digit) {
				$digitPos = count($digits) - $key;

				$digitString = '';

				if($digit == 0) {
					continue;
				}

				switch ($digitPos)
				{
					case 1: {
						$digitString = $this->upToTwentyNames[$digit];

						break;
					} case 2: {
						if($digit == 1) {
							$digitString = $this->upToTwentyNames[intval($digit . $digits[$key + 1])];;
						} else {
							$digitString = $this->twoDigitNames[$digit];
						}

						break;
					} case 3: {
						$portionString .= $this->threeDigitNames[$digit];

						break;
					}
				}

				$portionString .= $digitString . ' ';

				if($digitPos == 2 && $digit == 1) {
					break;
				}
			}

			if($portionString && $i != 0) {
				$portionString .= ' ' . $this->postfixNames[$i][0] .
					$this->generateWordEnding(
						intval($portion),
						$this->postfixNames[$i][1],
						$this->postfixNames[$i][2],
						$this->postfixNames[$i][3]
					);
			}

			$numberString = $portionString . ' ' . $numberString;
		}

		return $numberString;
	}

	public function getMoneyText($number, $delimiter = ',')
	{
		$parts = explode($delimiter, (string) $number);

		$whole = intval($parts[0]);
		$cents = intval(isset($parts[1]) ? $parts[1] : 0);

		$wholeString = self::getText($whole) . ' ' . $this->currencyNames['whole'][0] .
			self::generateWordEnding($whole,
				$this->currencyNames['whole'][1],
				$this->currencyNames['whole'][2],
				$this->currencyNames['whole'][3]
			);

		$centsString = self::getText($cents) . ' ' . $this->currencyNames['cents'][0] .
			self::generateWordEnding($cents,
				$this->currencyNames['cents'][1],
				$this->currencyNames['cents'][2],
				$this->currencyNames['cents'][3]
			);

		return $wholeString . ' ' . $this->currencyCombiner . ' ' . $centsString;
	}

	protected function generateWordEnding($count, $single, $multiple, $genitive)
	{
		$reminder = $single;
		$lastTwoDigits = substr($count, -2);
		$lastDigit = substr($count, -1);

		switch (true) {
			case $count > 1 && $count < 10: {
				$reminder = $multiple;
				break;
			} case $count % 10 == 0: {
			$reminder = $genitive;
			break;
		} case $lastTwoDigits > 10 && $lastTwoDigits < 20: {
			$reminder = $genitive;
			break;
		} case $lastDigit == 1: {
			$reminder = $single;
			break;
		} case $lastDigit > 1 && $lastDigit <= 9: {
			$reminder = $multiple;
			break;
		}
		}

		return $reminder;
	}
}