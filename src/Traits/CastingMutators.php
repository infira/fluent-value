<?php 
namespace Infira\FluentValue\Traits;

use Infira\FluentValue\FluentValue;

/**
 * @generated
 * @mixin FluentValue
 * @property-read $this $bool - proxy to method bool()
 * @property-read $this $int - proxy to method int()
 * @property-read $this $float - proxy to method float()
 * @property-read $this $array - proxy to method array()
 * @property-read $this $string - proxy to method string()
 * @property-read $this $type - proxy to method type()
 * @property-read $this $serialize - proxy to method serialize()
 * @property-read mixed $toUnSerialize - proxy to method toUnSerialize()
 * @property-read static $clone - proxy to method clone()
 * @property-read $this $md5 - proxy to method md5()
 * @property-read $this $sha1 - proxy to method sha1()
 * @property-read $this $crc32b - proxy to method crc32b()
 * @property-read $this $sha512 - proxy to method sha512()
 * @property-read $this $numeric - proxy to method numeric()
 * @property-read $this $formatNumber - proxy to method formatNumber()
 * @property-read $this $negative - proxy to method negative()
 * @property-read $this $positive - proxy to method positive()
 * @property-read $this $floor - proxy to method floor()
 * @property-read $this $ceil - proxy to method ceil()
 * @property-read $this $round - proxy to method round()
 * @property-read static $increment - proxy to method increment()
 * @property-read static $decrement - proxy to method decrement()
 * @property-read bool $ok - proxy to method ok()
 * @property-read bool $notOk - proxy to method notOk()
 * @property-read $this $eur - proxy to method eur()
 * @property-read $this $discount - proxy to method discount()
 * @property-read $this $markup - proxy to method markup()
 * @property-read $this $removeVat - proxy to method removeVat()
 * @property-read $this $addVat - proxy to method addVat()
 * @property-read $this $formatDate - proxy to method formatDate()
 * @property-read $this $formatStandardDate - proxy to method formatStandardDate()
 * @property-read $this $formatStandardDateTime - proxy to method formatStandardDateTime()
 * @property-read $this $time - proxy to method time()
 * @property-read $this $formatDateTime - proxy to method formatDateTime()
 * @property-read $this $formatDateNice - proxy to method formatDateNice()
 * @property-read $this $formatDateTimeNice - proxy to method formatDateTimeNice()
 * @property-read $this $formatTimeNice - proxy to method formatTimeNice()
 * @property-read $this $basename - proxy to method basename()
 * @property-read $this $urlEncode - proxy to method urlEncode()
 * @property-read $this $lines - proxy to method lines()
 * @property-read $this $json - proxy to method json()
 * @property-read $this $escapeHTML - proxy to method escapeHTML()
 * @property-read $this $addSlashes - proxy to method addSlashes()
 * @property-read $this $parseStr - proxy to method parseStr()
 * @property-read $this $htmlAttributes - proxy to method htmlAttributes()
 * @property-read $this $htmlToText - proxy to method htmlToText()
 * @property-read static $filter - proxy to method filter()
 * @property-read static $reject - proxy to method reject()
 * @property-read $this $first - proxy to method first()
 * @property-read $this $last - proxy to method last()
 * @property-read bool $fileExists - proxy to method fileExists()
 */
trait CastingMutators
{
	/**
	 * Get the underlying string value as a boolean.
	 * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
	 * @link https://www.php.net/manual/en/function.filter-var.php
	 * @see FluentValue::toBool()
	 * @generated
	 */
	public function bool(): static
	{
		return $this->new($this->toBool());
	}


	/**
	 * @see FluentValue::toInt()
	 * @generated
	 */
	public function int(): static
	{
		return $this->new($this->toInt());
	}


	/**
	 * @see FluentValue::toFloat()
	 * @generated
	 */
	public function float(): static
	{
		return $this->new($this->toFloat());
	}


	/**
	 * @see FluentValue::toArray()
	 * @generated
	 */
	public function array(): static
	{
		return $this->new($this->toArray());
	}


	/**
	 * @see FluentValue::toString()
	 * @generated
	 */
	public function string(): static
	{
		return $this->new($this->toString());
	}


	/**
	 * Get the type of variable
	 * @link https://php.net/manual/en/function.gettype.php
	 * @see FluentValue::toType()
	 * @generated
	 */
	public function type(): static
	{
		return $this->new($this->toType());
	}


	/**
	 * String representation of object.
	 * @link https://www.php.net/manual/en/function.serialize.php
	 * @return static
	 * @see FluentValue::toSerialize()
	 * @generated
	 */
	public function serialize(): static
	{
		return $this->new($this->toSerialize());
	}


	/**
	 * @see FluentValue::getAt()
	 * @generated
	 */
	public function at(int $index): static
	{
		return $this->new($this->getAt($index));
	}


	/**
	 * @param  callable  $callback  ($value,...$parameter)
	 * @param  mixed  ...$parameter
	 * @return static
	 * @see FluentValue::callSpread()
	 * @generated
	 */
	public function transform(callable $callback, mixed ...$parameter): static
	{
		return $this->new($this->callSpread($callback, $parameter));
	}


	/**
	 * @see  Hash::make()
	 * @see FluentValue::toMd5()
	 * @generated
	 */
	public function md5(): static
	{
		return $this->new($this->toMd5());
	}


	/**
	 * @see  Hash::make()
	 * @see FluentValue::toSha1()
	 * @generated
	 */
	public function sha1(): static
	{
		return $this->new($this->toSha1());
	}


	/**
	 * @see  Hash::make()
	 * @see FluentValue::toCrc32b()
	 * @generated
	 */
	public function crc32b(): static
	{
		return $this->new($this->toCrc32b());
	}


	/**
	 * @see  Hash::make()
	 * @see FluentValue::toSha512()
	 * @generated
	 */
	public function sha512(): static
	{
		return $this->new($this->toSha512());
	}


	/**
	 * @see FluentValue::toNumeric()
	 * @generated
	 */
	public function numeric(): static
	{
		return $this->new($this->toNumeric());
	}


	/**
	 * @see FluentValue::toFormattedNumber()
	 * @generated
	 */
	public function formatNumber(string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->toFormattedNumber($decimalSeparator, $thousand));
	}


	/**
	 * @see FluentValue::toNegative()
	 * @generated
	 */
	public function negative(): static
	{
		return $this->new($this->toNegative());
	}


	/**
	 * @see FluentValue::toPositive()
	 * @generated
	 */
	public function positive(): static
	{
		return $this->new($this->toPositive());
	}


	/**
	 * @see FluentValue::toMax()
	 * @generated
	 */
	public function max(mixed ...$max): static
	{
		return $this->new($this->toMax($max));
	}


	/**
	 * @see FluentValue::toMin()
	 * @generated
	 */
	public function min(mixed ...$max): static
	{
		return $this->new($this->toMin($max));
	}


	/**
	 * @see FluentValue::toFloor()
	 * @generated
	 */
	public function floor(): static
	{
		return $this->new($this->toFloor());
	}


	/**
	 * @see FluentValue::toCeil()
	 * @generated
	 */
	public function ceil(): static
	{
		return $this->new($this->toCeil());
	}


	/**
	 * @see FluentValue::toRounded()
	 * @generated
	 */
	public function round(int $decimals = 2): static
	{
		return $this->new($this->toRounded($decimals));
	}


	/**
	 * returns $value€
	 * @see FluentValue::toEur()
	 * @generated
	 */
	public function eur(): static
	{
		return $this->new($this->toEur());
	}


	/**
	 * Format money
	 * @see FluentValue::toMoney()
	 * @generated
	 */
	public function money(string $currency, string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->toMoney($currency, $decimalSeparator, $thousand));
	}


	/**
	 * @see FluentValue::getWithDiscount()
	 * @generated
	 */
	public function discount(float $percent = 0): static
	{
		return $this->new($this->getWithDiscount($percent));
	}


	/**
	 * @see FluentValue::getWithMarkup()
	 * @generated
	 */
	public function markup(float $percent = 0): static
	{
		return $this->new($this->getWithMarkup($percent));
	}


	/**
	 * @see FluentValue::getVatExcluded()
	 * @generated
	 */
	public function removeVat(float $vatPercent = null): static
	{
		return $this->new($this->getVatExcluded($vatPercent));
	}


	/**
	 * @see FluentValue::getVatIncluded()
	 * @generated
	 */
	public function addVat(float $vatPercent = null): static
	{
		return $this->new($this->getVatIncluded($vatPercent));
	}


	/**
	 * Get VAT(value added tax) of current value
	 * @see FluentValue::getVatOf()
	 * @generated
	 */
	public function vat(bool $priceContainsVat, float $vatPercent = null): static
	{
		return $this->new($this->getVatOf($priceContainsVat, $vatPercent));
	}


	/**
	 * @see FluentValue::toFormattedDate()
	 * @generated
	 */
	public function formatDate(string $format = "d.m.Y"): static
	{
		return $this->new($this->toFormattedDate($format));
	}


	/**
	 * @see FluentValue::toStandardDate()
	 * @generated
	 */
	public function formatStandardDate(string $format = "Y-m-d"): static
	{
		return $this->new($this->toStandardDate($format));
	}


	/**
	 * @see FluentValue::toStandardDateTime()
	 * @generated
	 */
	public function formatStandardDateTime(string $format = "Y-m-d H:i:s"): static
	{
		return $this->new($this->toStandardDateTime($format));
	}


	/**
	 * @see FluentValue::toTime()
	 * @generated
	 */
	public function time(): static
	{
		return $this->new($this->toTime());
	}


	/**
	 * @see FluentValue::toFormattedDateTime()
	 * @generated
	 */
	public function formatDateTime($format = "d.m.Y H:i:s"): static
	{
		return $this->new($this->toFormattedDateTime($format));
	}


	/**
	 * @see FluentValue::toFormattedDateNice()
	 * @generated
	 */
	public function formatDateNice(string $format = "j. F Y"): static
	{
		return $this->new($this->toFormattedDateNice($format));
	}


	/**
	 * @see FluentValue::toFormattedDateTimeNice()
	 * @generated
	 */
	public function formatDateTimeNice(string $format = "j. F Y H:i:s"): static
	{
		return $this->new($this->toFormattedDateTimeNice($format));
	}


	/**
	 * @see FluentValue::toFormattedTimeNice()
	 * @generated
	 */
	public function formatTimeNice(string $format = "H:i"): static
	{
		return $this->new($this->toFormattedTimeNice($format));
	}


	/**
	 * Returns trailing name component of path/class-string
	 * @see  Flu::basename
	 * @see FluentValue::toBasename()
	 * @generated
	 */
	public function basename(): static
	{
		return $this->new($this->toBasename());
	}


	/**
	 * URL-encodes string
	 * @link https://php.net/manual/en/function.urlencode.php
	 * @see FluentValue::toEncodedURL()
	 * @generated
	 */
	public function urlEncode(): static
	{
		return $this->new($this->toEncodedURL());
	}


	/**
	 * Join array elements with a string
	 * @link https://php.net/manual/en/function.implode.php
	 * @see FluentValue::toImploded()
	 * @generated
	 */
	public function join(string $glue): static
	{
		return $this->new($this->toImploded($glue));
	}


	/**
	 * Split a string by a string
	 * @link https://php.net/manual/en/function.explode.php
	 * @see FluentValue::toExploded()
	 * @generated
	 */
	public function explode(string $separator): static
	{
		return $this->new($this->toExploded($separator));
	}


	/**
	 * Split lines into array
	 * @see FluentValue::toLines()
	 * @generated
	 */
	public function lines(): static
	{
		return $this->new($this->toLines());
	}


	/**
	 * Return a formatted string
	 * @see FluentValue::toFormatted()
	 * @example flu('gen')->getFormattedText('my name is {%value%}, and im %s age of old',39) //my name is gen, and im 39 age of old
	 * @generated
	 */
	public function format(string $format, mixed ...$values): static
	{
		return $this->new($this->toFormatted($format, $values));
	}


	/**
	 * Returns the JSON representation of a value
	 * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
	 * @return static
	 * @link https://php.net/manual/en/function.json-encode.php
	 * @throws \JsonException
	 * @see FluentValue::toEncodedJson()
	 * @generated
	 */
	public function json(bool $pretty = false): static
	{
		return $this->new($this->toEncodedJson($pretty));
	}


	/**
	 * Return a formatted string
	 * @link @link https://php.net/manual/en/function.sprintf.php
	 * @see FluentValue::toSprintf()
	 * @generated
	 */
	public function sprintf(mixed ...$values): static
	{
		return $this->new($this->toSprintf($values));
	}


	/**
	 * Return a formatted string
	 * @link @link https://php.net/manual/en/function.vsprintf.php
	 * @see FluentValue::toVSprintf()
	 * @generated
	 */
	public function vsprintf(mixed $values): static
	{
		return $this->new($this->toVSprintf($values));
	}


	/**
	 * @link https://php.net/manual/en/function.htmlspecialchars.php
	 * @see FluentValue::toEncodedHTML()
	 * @generated
	 */
	public function escapeHTML(bool $doubleEncode = true): static
	{
		return $this->new($this->toEncodedHTML($doubleEncode));
	}


	/**
	 * Quote string with slashes
	 * @link https://php.net/manual/en/function.addslashes.php
	 * @see FluentValue::toSlashedString()
	 * @generated
	 */
	public function addSlashes(): static
	{
		return $this->new($this->toSlashedString());
	}


	/**
	 * Parses the string into variables
	 * @link https://www.php.net/manual/en/function.parse-str.php
	 * @see FluentValue::toParseStr()
	 * @generated
	 */
	public function parseStr(): static
	{
		return $this->new($this->toParseStr());
	}


	/**
	 * Parses the string into variables
	 * @link https://www.php.net/manual/en/function.parse-str.php
	 * @see FluentValue::toHTMLAttributes()
	 * @return static
	 * @generated
	 */
	public function htmlAttributes(): static
	{
		return $this->new($this->toHTMLAttributes());
	}


	/**
	 * Parses the string into variables
	 * @link https://www.php.net/manual/en/function.parse-str.php
	 * @see FluentValue::toTextFromHTML()
	 * @generated
	 */
	public function htmlToText(): static
	{
		return $this->new($this->toTextFromHTML());
	}


	/**
	 * Get the string matching the given pattern.
	 * @see  Regex::matchAll
	 * @see FluentValue::getAllMatches()
	 * @generated
	 */
	public function matchAll(string $pattern): static
	{
		return $this->new($this->getAllMatches($pattern));
	}


	/**
	 * Merge array
	 * @link https://www.php.net/manual/en/function.parse-str.php
	 * @see FluentValue::getMerged()
	 * @generated
	 */
	public function merge(array ...$array): static
	{
		return $this->new($this->getMerged($array));
	}


	/**
	 * Return the first element in an array passing a given truth test.
	 * @see  Arr::first()
	 * @see FluentValue::toFirst()
	 * @generated
	 */
	public function first(callable $callback = null, $default = null): static
	{
		return $this->new($this->toFirst($callback, $default));
	}


	/**
	 * Return the last element in an array passing a given truth test.
	 * @see  Arr::last()
	 * @see FluentValue::toLast()
	 * @generated
	 */
	public function last(callable $callback = null, $default = null): static
	{
		return $this->new($this->toLast($callback, $default));
	}


	/**
	 * Add .$extension to current value
	 * @see FluentValue::toFilename()
	 * @generated
	 */
	public function filename(?string $extension): static
	{
		return $this->new($this->toFilename($extension));
	}
}
