<?php 
namespace Infira\FluentValue\Traits;

use Infira\FluentValue\FluentValue;

/**
 * @mixin FluentValue
 * @generated
 * @template TKey
 * @template TValue
 * @property-read FluentValue $size - transform underlying value using count()/strlen()
 * @property-read FluentValue $basename - Returns trailing name component of path/class-string
 * @property-read FluentValue $encodedURL - URL-encodes string
 * @property-read FluentValue $lines - Split lines into array
 * @property-read FluentValue $json - Returns the JSON representation of a value
 * @property-read FluentValue $slashedString - Quote string with slashes
 * @property-read FluentValue $parsedStr - Parses the string into variables
 * @property-read FluentValue $serialized - String representation of object.
 * @property-read FluentValue $unserialized - Constructs the object.
 * @property-read FluentValue $characters - transform underlying value characters array
 * @property-read FluentValue $rendered - Simple string templating
 * @property-read FluentValue $md - Get md5 hash
 * @property-read FluentValue $sha1 - Get sha1 hash
 * @property-read FluentValue $crc32b - Get crc32b hash
 * @property-read FluentValue $sha512 - Get sha512 hash
 * @property-read FluentValue $numeric
 * @property-read FluentValue $formattedNumber
 * @property-read FluentValue $negative
 * @property-read FluentValue $positive
 * @property-read FluentValue $floor
 * @property-read FluentValue $ceil
 * @property-read FluentValue $round
 * @property-read FluentValue $increment
 * @property-read FluentValue $decrement
 * @property-read FluentValue $bool - transform underlying value to bool
 * @property-read FluentValue $int - transform underlying value to integer
 * @property-read FluentValue $float - transform underlying value to float
 * @property-read FluentValue $array - transform underlying value to array
 * @property-read FluentValue $string - transform underlying value to string
 * @property-read FluentValue $type - transform underlying value to variable type
 * @property-read FluentValue $eur - Format value as number and append € currency sign
 * @property-read FluentValue $dollar - Format value as number and append $ currency sign
 * @property-read FluentValue $vatExcluded - FluentValue where VAT(value added tax) is excluded
 * @property-read FluentValue $vatIncluded - FluentValue where VAT(value added tax) is included
 * @property-read FluentValue $formatDate - Convert value to date formatted string using $format If $format is not provided getDefaultDateFormat() is used
 * @property-read FluentValue $formatDateTime - Convert value to date formatted using getDefaultDateTimeFormat()
 * @property-read FluentValue $formatStandardDate - Converts value to date format Y-m-d
 * @property-read FluentValue $formatStandardDateTime - Converts value to date format Y-m-d H:i:s
 * @property-read FluentValue $timestamp
 * @property-read FluentValue $isBool
 * @property-read FluentValue $isInt
 * @property-read FluentValue $isString
 * @property-read FluentValue $isFloat
 * @property-read FluentValue $isNumeric
 * @property-read FluentValue $isNull
 * @property-read FluentValue $isArray
 * @property-read FluentValue $isIterable
 * @property-read FluentValue $isCountable
 * @property-read FluentValue $isObject
 * @property-read FluentValue $canOffset
 * @property-read FluentValue $isEmpty
 * @property-read FluentValue $isNotEmpty
 * @property-read FluentValue $ok - Has conditional value When value is string and "1", "true", "on", and "yes" then returns true Otherwise it validates using empty()
 * @property-read FluentValue $notOk
 * @property-read FluentValue $htmlAttributes - Parses the string into variables
 * @property-read FluentValue $textFromHTML - Parses the string into variables
 * @property-read FluentValue $escapedHTML
 * @property-read FluentValue $filter - reject empty
 * @property-read FluentValue $reject - reject not empty
 * @property-read FluentValue $first - Return the first element in an array passing a given truth test.
 * @property-read FluentValue $last - Return the last element in an array passing a given truth test.
 * @property-read FluentValue $path - Convert value to path
 * @property-read FluentValue $extension - Return file extension. If current value is not file then try to get extension manually using string manipulations
 * ############# Start of laravel Stringable proxies
 * @property-read $this $newLine - Append a new line to the string.
 * @property-read $this $ascii - Transliterate a UTF-8 value to ASCII.
 * @property-read $this $camel - Convert a value to camel case.
 * @property-read $this $dirname - Get the parent directory's path.
 * @property-read $this $kebab - Convert a string to kebab case.
 * @property-read $this $limit - Limit the number of characters in a string.
 * @property-read $this $lower - Convert the given string to lower-case.
 * @property-read $this $markdown - Convert GitHub flavored Markdown into HTML.
 * @property-read $this $inlineMarkdown - Convert inline Markdown into HTML.
 * @property-read $this $plural - Get the plural form of an English word.
 * @property-read $this $pluralStudly - Pluralize the last word of an English, studly caps case string.
 * @property-read $this $reverse - Reverse the string.
 * @property-read $this $squish - Remove all "extra" blank space from the given string.
 * @property-read $this $stripTags - Strip HTML and PHP tags from the given string.
 * @property-read $this $upper - Convert the given string to upper-case.
 * @property-read $this $title - Convert the given string to title case.
 * @property-read $this $headline - Convert the given string to title case for each word.
 * @property-read $this $singular - Get the singular form of an English word.
 * @property-read $this $slug - Generate a URL friendly "slug" from a given string.
 * @property-read $this $snake - Convert a string to snake case.
 * @property-read $this $studly - Convert a value to studly caps case.
 * @property-read $this $trim - Trim the string of the given characters.
 * @property-read $this $ltrim - Left trim the string of the given characters.
 * @property-read $this $rtrim - Right trim the string of the given characters.
 * @property-read $this $lcfirst - Make a string's first character lowercase.
 * @property-read $this $ucfirst - Make a string's first character uppercase.
 * @property-read $this $words - Limit the number of words in a string.
 * ############# End of laravel Stringable proxies
 */
trait FluentImmutableValue
{
	/**
	 * Append values works for array and strings
	 *
	 * @param  mixed  ...$values
	 * @return static
	 * @generated
	 */
	public function append(mixed ...$values): static
	{
		return $this->new($this->proc->append(...$values));
	}


	/**
	 * @param  (callable(TKey,TValue): mixed)  $callback
	 * @param  mixed  ...$parameter
	 * @return static
	 * @generated
	 */
	public function transform(callable $callback, mixed ...$parameter): static
	{
		return $this->new($this->proc->transform($callback, ...$parameter));
	}


	/**
	 * Get offset value
	 *
	 * @param  string|int  $key
	 * @return static
	 * @generated
	 */
	public function at(string|int $key): static
	{
		return $this->new($this->proc->at($key));
	}


	/**
	 * Get size, if underlying value is array then count else strlen
	 *
	 * @return static
	 * @generated
	 */
	public function size(): static
	{
		return $this->new($this->proc->size());
	}


	/**
	 * Returns trailing name component of path/class-string
	 *
	 * @return static
	 * @see  Flu::basename
	 * @generated
	 */
	public function basename(): static
	{
		return $this->new($this->proc->basename());
	}


	/**
	 * @alias FluentValueProcessor::basename()
	 * @generated
	 */
	public function toBaseName(): string
	{
		return $this->proc->basename();
	}


	/**
	 * URL-encodes string
	 *
	 * @return static
	 * @generated
	 */
	public function urlEncode(): static
	{
		return $this->new($this->proc->urlEncode());
	}


	/**
	 * @alias FluentValueProcessor::urlEncode()
	 * @generated
	 */
	public function toEncodedURL(): string
	{
		return $this->proc->urlEncode();
	}


	/**
	 * Join array elements with a string
	 *
	 * @param  string  $glue
	 * @return static
	 * @generated
	 */
	public function implode(string $glue): static
	{
		return $this->new($this->proc->implode($glue));
	}


	/**
	 * @alias FluentValueProcessor::implode()
	 * @generated
	 */
	public function toImploded(string $glue): string
	{
		return $this->proc->implode($glue);
	}


	/**
	 * Join array elements with a string
	 *
	 * @alias self::implode
	 * @param  string  $glue
	 * @return static
	 * @generated
	 */
	public function join(string $glue): static
	{
		return $this->new($this->proc->join($glue));
	}


	/**
	 * Split a string by a string
	 *
	 * @param  string  $separator
	 * @return static
	 * @generated
	 */
	public function explode(string $separator): static
	{
		return $this->new($this->proc->explode($separator));
	}


	/**
	 * @alias FluentValueProcessor::explode()
	 * @generated
	 */
	public function toExploded(string $separator): array
	{
		return $this->proc->explode($separator);
	}


	/**
	 * Split lines into array
	 *
	 * @return static
	 * @generated
	 */
	public function lines(): static
	{
		return $this->new($this->proc->lines());
	}


	/**
	 * @alias FluentValueProcessor::lines()
	 * @generated
	 */
	public function toLines(): array
	{
		return $this->proc->lines();
	}


	/**
	 * Surround value with
	 *
	 * @example flu('value')->surround('{}') // {value}
	 * @example flu('value')->surround('left_','_right') // left_value_right
	 * @example flu('value')->surround(['left_','_right']) // left_value_right
	 * @param  string|array  $wrap
	 * @param  string|null  $right
	 * @return static
	 * @generated
	 */
	public function surround(string|array $wrap, string $right = null): static
	{
		return $this->new($this->proc->surround($wrap, $right));
	}


	/**
	 * @alias FluentValueProcessor::surround()
	 * @generated
	 */
	public function toSurrounded(string|array $wrap, string $right = null): string
	{
		return $this->proc->surround($wrap, $right);
	}


	/**
	 * Return a formatted string
	 *
	 * @example flu('gen')->getFormattedText('my name is {%value%}, and im %s age of old',39) //my name is gen, and im 39 age of old
	 * @param  string  $format
	 * @param  mixed  ...$values
	 * @return static
	 * @generated
	 */
	public function format(string $format, mixed ...$values): static
	{
		return $this->new($this->proc->format($format, ...$values));
	}


	/**
	 * @alias FluentValueProcessor::format()
	 * @generated
	 */
	public function toFormatted(string $format, mixed ...$values): string
	{
		return $this->proc->format($format, ...$values);
	}


	/**
	 * Returns the JSON representation of a value
	 *
	 * @param  bool  $pretty  JSON_PRETTY_PRINT - https://www.php.net/manual/en/json.constants.php
	 * @return static
	 * @throws \JsonException
	 * @generated
	 */
	public function json(bool $pretty = false): static
	{
		return $this->new($this->proc->json($pretty));
	}


	/**
	 * @alias FluentValueProcessor::json()
	 * @generated
	 */
	public function toEncodedJson(bool $pretty = false): string
	{
		return $this->proc->json($pretty);
	}


	/**
	 * Return a formatted string
	 *
	 * @param  mixed  ...$values
	 * @return static
	 * @generated
	 */
	public function sprintf(mixed ...$values): static
	{
		return $this->new($this->proc->sprintf(...$values));
	}


	/**
	 * @alias FluentValueProcessor::sprintf()
	 * @generated
	 */
	public function toSprintf(mixed ...$values): string
	{
		return $this->proc->sprintf(...$values);
	}


	/**
	 * Return a formatted string
	 *
	 * @param  mixed  $values
	 * @return static
	 * @generated
	 */
	public function vsprintf(mixed $values): static
	{
		return $this->new($this->proc->vsprintf($values));
	}


	/**
	 * @alias FluentValueProcessor::vsprintf()
	 * @generated
	 */
	public function toVSprintf(mixed $values): string
	{
		return $this->proc->vsprintf($values);
	}


	/**
	 * Quote string with slashes
	 *
	 * @return static
	 * @generated
	 */
	public function addSlashes(): static
	{
		return $this->new($this->proc->addSlashes());
	}


	/**
	 * @alias FluentValueProcessor::addSlashes()
	 * @generated
	 */
	public function toSlashedString(): string
	{
		return $this->proc->addSlashes();
	}


	/**
	 * Parses the string into variables
	 *
	 * @return static
	 * @generated
	 */
	public function parseStr(): static
	{
		return $this->new($this->proc->parseStr());
	}


	/**
	 * @alias FluentValueProcessor::parseStr()
	 * @generated
	 */
	public function toParseStr(): array
	{
		return $this->proc->parseStr();
	}


	/**
	 * Get the string matching the given pattern.
	 *
	 * @param  string  $pattern
	 * @return static
	 * @see  Regex::match()
	 * @generated
	 */
	public function match(string $pattern): static
	{
		return $this->new($this->proc->match($pattern));
	}


	/**
	 * @alias FluentValueProcessor::match()
	 * @generated
	 */
	public function getMatch(string $pattern): string
	{
		return $this->proc->match($pattern);
	}


	/**
	 * Get the string matching the given pattern.
	 *
	 * @param  string  $pattern
	 * @return static
	 * @see  Regex::matchAll
	 * @generated
	 */
	public function matchAll(string $pattern): static
	{
		return $this->new($this->proc->matchAll($pattern));
	}


	/**
	 * @alias FluentValueProcessor::matchAll()
	 * @generated
	 */
	public function getAllMatches(string $pattern): array
	{
		return $this->proc->matchAll($pattern);
	}


	/**
	 * String representation of object.
	 *
	 * @return static
	 * @generated
	 */
	public function serialize(): static
	{
		return $this->new($this->proc->serialize());
	}


	/**
	 * @alias FluentValueProcessor::serialize()
	 * @generated
	 */
	public function toSerialized(): string
	{
		return $this->proc->serialize();
	}


	/**
	 * Constructs the object.
	 *
	 * @param  array  $options
	 * @return static
	 * @generated
	 */
	public function unserialize(array $options = []): static
	{
		return $this->new($this->proc->unserialize($options));
	}


	/**
	 * @alias FluentValueProcessor::unserialize()
	 * @generated
	 */
	public function toUnserialized(array $options = []): mixed
	{
		return $this->proc->unserialize($options);
	}


	/**
	 * Get array of its characters
	 *
	 * @param  int  $length
	 * @return static
	 * @generated
	 */
	public function characters(int $length = 1): static
	{
		return $this->new($this->proc->characters($length));
	}


	/**
	 * @alias FluentValueProcessor::characters()
	 * @generated
	 */
	public function getCharacters(int $length = 1): array
	{
		return $this->proc->characters($length);
	}


	/**
	 * @generated
	 */
	public function withRenderProcessor(callable $processor): static
	{
		return $this->new($this->proc->withRenderProcessor($processor));
	}


	/**
	 * Simple string templating
	 *
	 * @example flu('my name is {name}')->render(['name' => 'gen']) // 'my name is gen'
	 * @param  array  $data
	 * @return static
	 * @generated
	 */
	public function render(array $data = []): static
	{
		return $this->new($this->proc->render($data));
	}


	/**
	 * Get md5 hash
	 *
	 * @return static
	 * @see  Hash::make()
	 * @generated
	 */
	public function md5(): static
	{
		return $this->new($this->proc->md5());
	}


	/**
	 * @alias FluentValueProcessor::md5()
	 * @generated
	 */
	public function toMd5(): string
	{
		return $this->proc->md5();
	}


	/**
	 * Get sha1 hash
	 *
	 * @return static
	 * @see  Hash::make()
	 * @generated
	 */
	public function sha1(): static
	{
		return $this->new($this->proc->sha1());
	}


	/**
	 * @alias FluentValueProcessor::sha1()
	 * @generated
	 */
	public function toSha1(): string
	{
		return $this->proc->sha1();
	}


	/**
	 * Get crc32b hash
	 *
	 * @return static
	 * @see  Hash::make()
	 * @generated
	 */
	public function crc32b(): static
	{
		return $this->new($this->proc->crc32b());
	}


	/**
	 * @alias FluentValueProcessor::crc32b()
	 * @generated
	 */
	public function toCrc32b(): string
	{
		return $this->proc->crc32b();
	}


	/**
	 * Get sha512 hash
	 *
	 * @return static
	 * @see  Hash::make()
	 * @generated
	 */
	public function sha512(): static
	{
		return $this->new($this->proc->sha512());
	}


	/**
	 * @alias FluentValueProcessor::sha512()
	 * @generated
	 */
	public function toSha512(): string
	{
		return $this->proc->sha512();
	}


	/**
	 * @return static
	 * @generated
	 */
	public function numeric(): static
	{
		return $this->new($this->proc->numeric());
	}


	/**
	 * @alias FluentValueProcessor::numeric()
	 * @generated
	 */
	public function toNumeric(): float|int
	{
		return $this->proc->numeric();
	}


	/**
	 * @param  string  $decimalSeparator
	 * @param  string  $thousand
	 * @return static
	 * @generated
	 */
	public function formatNumber(string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->proc->formatNumber($decimalSeparator, $thousand));
	}


	/**
	 * @alias FluentValueProcessor::formatNumber()
	 * @generated
	 */
	public function toFormattedNumber(string $decimalSeparator = ',', string $thousand = ''): string
	{
		return $this->proc->formatNumber($decimalSeparator, $thousand);
	}


	/**
	 * @return static
	 * @generated
	 */
	public function negative(): static
	{
		return $this->new($this->proc->negative());
	}


	/**
	 * @alias FluentValueProcessor::negative()
	 * @generated
	 */
	public function toNegative(): float|int
	{
		return $this->proc->negative();
	}


	/**
	 * @return static
	 * @generated
	 */
	public function positive(): static
	{
		return $this->new($this->proc->positive());
	}


	/**
	 * @alias FluentValueProcessor::positive()
	 * @generated
	 */
	public function toPositive(): float|int
	{
		return $this->proc->positive();
	}


	/**
	 * @param  mixed  ...$max
	 * @return static
	 * @generated
	 */
	public function max(mixed ...$max): static
	{
		return $this->new($this->proc->max(...$max));
	}


	/**
	 * @alias FluentValueProcessor::max()
	 * @generated
	 */
	public function toMax(mixed ...$max): mixed
	{
		return $this->proc->max(...$max);
	}


	/**
	 * @param  mixed  ...$max
	 * @return static
	 * @generated
	 */
	public function min(mixed ...$max): static
	{
		return $this->new($this->proc->min(...$max));
	}


	/**
	 * @alias FluentValueProcessor::min()
	 * @generated
	 */
	public function toMin(mixed ...$max): mixed
	{
		return $this->proc->min(...$max);
	}


	/**
	 * @return static
	 * @generated
	 */
	public function floor(): static
	{
		return $this->new($this->proc->floor());
	}


	/**
	 * @alias FluentValueProcessor::floor()
	 * @generated
	 */
	public function toFloor(): float
	{
		return $this->proc->floor();
	}


	/**
	 * @return static
	 * @generated
	 */
	public function ceil(): static
	{
		return $this->new($this->proc->ceil());
	}


	/**
	 * @alias FluentValueProcessor::ceil()
	 * @generated
	 */
	public function toCeil(): float
	{
		return $this->proc->ceil();
	}


	/**
	 * @param  int  $decimals
	 * @return static
	 * @generated
	 */
	public function round(int $decimals = 2): static
	{
		return $this->new($this->proc->round($decimals));
	}


	/**
	 * @alias FluentValueProcessor::round()
	 * @generated
	 */
	public function toRounded(int $decimals = 2): float|int
	{
		return $this->proc->round($decimals);
	}


	/**
	 * @param  int  $by
	 * @return static
	 * @generated
	 */
	public function increment(int $by = 1): static
	{
		return $this->new($this->proc->increment($by));
	}


	/**
	 * @alias FluentValueProcessor::increment()
	 * @generated
	 */
	public function getIncremented(int $by = 1): float|int
	{
		return $this->proc->increment($by);
	}


	/**
	 * @param  int  $by
	 * @return static
	 * @generated
	 */
	public function decrement(int $by = 1): static
	{
		return $this->new($this->proc->decrement($by));
	}


	/**
	 * @alias FluentValueProcessor::decrement()
	 * @generated
	 */
	public function getDecremented(int $by = 1): float|int
	{
		return $this->proc->decrement($by);
	}


	/**
	 * @param  float|int  $value
	 * @return static
	 * @generated
	 */
	public function add(float|int $value): static
	{
		return $this->new($this->proc->add($value));
	}


	/**
	 * @alias FluentValueProcessor::add()
	 * @generated
	 */
	public function getAdded(float|int $value): float|int
	{
		return $this->proc->add($value);
	}


	/**
	 * @param  float|int  $value
	 * @return static
	 * @generated
	 */
	public function subtract(float|int $value): static
	{
		return $this->new($this->proc->subtract($value));
	}


	/**
	 * @alias FluentValueProcessor::subtract()
	 * @generated
	 */
	public function getSubtracted(float|int $value): float|int
	{
		return $this->proc->subtract($value);
	}


	/**
	 * @param  float|int  $value
	 * @return static
	 * @generated
	 */
	public function multiply(float|int $value): static
	{
		return $this->new($this->proc->multiply($value));
	}


	/**
	 * @alias FluentValueProcessor::multiply()
	 * @generated
	 */
	public function getMultiplied(float|int $value): float|int
	{
		return $this->proc->multiply($value);
	}


	/**
	 * @param  float|int  $value
	 * @return static
	 * @generated
	 */
	public function divide(float|int $value): static
	{
		return $this->new($this->proc->divide($value));
	}


	/**
	 * @alias FluentValueProcessor::divide()
	 * @generated
	 */
	public function getDivided(float|int $value): float|int
	{
		return $this->proc->divide($value);
	}


	/**
	 * @param  float|int  $percent
	 * @return static
	 * @generated
	 */
	public function increaseByPercent(float|int $percent): static
	{
		return $this->new($this->proc->increaseByPercent($percent));
	}


	/**
	 * @alias FluentValueProcessor::increaseByPercent()
	 * @generated
	 */
	public function getIncreasedByPercent(float|int $percent): float|int
	{
		return $this->proc->increaseByPercent($percent);
	}


	/**
	 * @param  float|int  $percent
	 * @return static
	 * @generated
	 */
	public function decreaseByPercent(float|int $percent): static
	{
		return $this->new($this->proc->decreaseByPercent($percent));
	}


	/**
	 * @alias FluentValueProcessor::decreaseByPercent()
	 * @generated
	 */
	public function getDecreasedByPercent(float|int $percent): float|int
	{
		return $this->proc->decreaseByPercent($percent);
	}


	/**
	 * Get the underlying string value as a boolean.
	 * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
	 *
	 * @return static
	 * @generated
	 */
	public function bool(): static
	{
		return $this->new($this->proc->bool());
	}


	/**
	 * @alias FluentValueProcessor::bool()
	 * @generated
	 */
	public function toBool(): bool
	{
		return $this->proc->bool();
	}


	/**
	 * Cast to int
	 *
	 * @return static
	 * @generated
	 */
	public function int(): static
	{
		return $this->new($this->proc->int());
	}


	/**
	 * @alias FluentValueProcessor::int()
	 * @generated
	 */
	public function toInt(): int
	{
		return $this->proc->int();
	}


	/**
	 * Cast to array
	 *
	 * @return static
	 * @generated
	 */
	public function float(): static
	{
		return $this->new($this->proc->float());
	}


	/**
	 * @alias FluentValueProcessor::float()
	 * @generated
	 */
	public function toFloat(): float
	{
		return $this->proc->float();
	}


	/**
	 * @return static
	 * @generated
	 */
	public function array(): static
	{
		return $this->new($this->proc->array());
	}


	/**
	 * @alias FluentValueProcessor::array()
	 * @generated
	 */
	public function toArray(): array
	{
		return $this->proc->array();
	}


	/**
	 * Get string
	 *
	 * @return static
	 * @generated
	 */
	public function string(): static
	{
		return $this->new($this->proc->string());
	}


	/**
	 * @alias FluentValueProcessor::string()
	 * @generated
	 */
	public function toString(): string
	{
		return $this->proc->string();
	}


	/**
	 * Get the type of variable
	 *
	 * @return static
	 * @generated
	 */
	public function type(): static
	{
		return $this->new($this->proc->type());
	}


	/**
	 * @alias FluentValueProcessor::type()
	 * @generated
	 */
	public function toType(): string
	{
		return $this->proc->type();
	}


	/**
	 * Format value as number and append € currency sign
	 *
	 * @example flu(10000.50)->eur() // "10000,50€"
	 * @example flu(10000.50)->eur('.',' ') // "10 000.50€"
	 * @param  string  $decimalSeparator
	 * @param  string  $thousand
	 * @return static
	 * @generated
	 */
	public function eur(string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->proc->eur($decimalSeparator, $thousand));
	}


	/**
	 * @alias FluentValueProcessor::eur()
	 * @generated
	 */
	public function toEur(string $decimalSeparator = ',', string $thousand = ''): string
	{
		return $this->proc->eur($decimalSeparator, $thousand);
	}


	/**
	 * Format value as number and append $ currency sign
	 *
	 * @example flu(10000.50)->dollar('.',' ') // "10 000.50$"
	 * @example flu(10000.50)->dollar() // "10000,50$"
	 * @param  string  $decimalSeparator
	 * @param  string  $thousand
	 * @return static
	 * @generated
	 */
	public function dollar(string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->proc->dollar($decimalSeparator, $thousand));
	}


	/**
	 * @alias FluentValueProcessor::dollar()
	 * @generated
	 */
	public function toDollar(string $decimalSeparator = ',', string $thousand = ''): string
	{
		return $this->proc->dollar($decimalSeparator, $thousand);
	}


	/**
	 * Format money
	 *
	 * @example flu(10000.50)->money('$') // "10000,50$"
	 * @example flu(10000.50)->money('$','.',' ') // "10 000.50$"
	 * @param  string  $thousand
	 * @param  string  $currency
	 * @param  string  $decimalSeparator
	 * @return static
	 * @generated
	 */
	public function money(string $currency, string $decimalSeparator = ',', string $thousand = ''): static
	{
		return $this->new($this->proc->money($currency, $decimalSeparator, $thousand));
	}


	/**
	 * @alias FluentValueProcessor::money()
	 * @generated
	 */
	public function toMoney(string $currency, string $decimalSeparator = ',', string $thousand = ''): string
	{
		return $this->proc->money($currency, $decimalSeparator, $thousand);
	}


	/**
	 * @param  float|int  $percent
	 * @return static
	 * @generated
	 */
	public function discount(float|int $percent): static
	{
		return $this->new($this->proc->discount($percent));
	}


	/**
	 * @alias FluentValueProcessor::discount()
	 * @generated
	 */
	public function getWithDiscount(float|int $percent): float|int
	{
		return $this->proc->discount($percent);
	}


	/**
	 * Add markup to value
	 *
	 * @param  float|int  $percent
	 * @return static
	 * @generated
	 */
	public function markup(float|int $percent): static
	{
		return $this->new($this->proc->markup($percent));
	}


	/**
	 * @alias FluentValueProcessor::markup()
	 * @generated
	 */
	public function getWithMarkup(float|int $percent): float|int
	{
		return $this->proc->markup($percent);
	}


	/**
	 * Remove VAT(value added tax) from value
	 *
	 * @param  float|int|null  $vatPercent
	 * @return static
	 * @generated
	 */
	public function removeVat(float|int $vatPercent = null): static
	{
		return $this->new($this->proc->removeVat($vatPercent));
	}


	/**
	 * @alias FluentValueProcessor::removeVat()
	 * @generated
	 */
	public function getVatExcluded(float|int $vatPercent = null): float|int
	{
		return $this->proc->removeVat($vatPercent);
	}


	/**
	 * Add VAT(value added tax) to value
	 *
	 * @param  float|int|null  $vatPercent
	 * @return static
	 * @generated
	 */
	public function addVat(float|int $vatPercent = null): static
	{
		return $this->new($this->proc->addVat($vatPercent));
	}


	/**
	 * @alias FluentValueProcessor::addVat()
	 * @generated
	 */
	public function getVatIncluded(float|int $vatPercent = null): float|int
	{
		return $this->proc->addVat($vatPercent);
	}


	/**
	 * Get VAT(value added tax) of current value
	 *
	 * @param  bool  $priceContainsVat
	 * @param  float|int|null  $vatPercent
	 * @return static
	 * @generated
	 */
	public function vat(bool $priceContainsVat, float|int $vatPercent = null): static
	{
		return $this->new($this->proc->vat($priceContainsVat, $vatPercent));
	}


	/**
	 * @alias FluentValueProcessor::vat()
	 * @generated
	 */
	public function getVat(bool $priceContainsVat, float|int $vatPercent = null): float|int
	{
		return $this->proc->vat($priceContainsVat, $vatPercent);
	}


	/**
	 * Convert value to date formatted string using $format
	 * If $format is not provided getDefaultDateFormat() is used
	 *
	 * @param  string|null  $format
	 * @return static
	 * @generated
	 */
	public function formatDate(string $format = null): static
	{
		return $this->new($this->proc->formatDate($format));
	}


	/**
	 * @alias FluentValueProcessor::formatDate()
	 * @generated
	 */
	public function toFormattedDate(string $format = null): string
	{
		return $this->proc->formatDate($format);
	}


	/**
	 * Convert value to date formatted using getDefaultDateTimeFormat()
	 *
	 * @return static
	 * @generated
	 */
	public function formatDateTime(): static
	{
		return $this->new($this->proc->formatDateTime());
	}


	/**
	 * @alias FluentValueProcessor::formatDateTime()
	 * @generated
	 */
	public function toFormattedDateTime(): string
	{
		return $this->proc->formatDateTime();
	}


	/**
	 * Converts value to date format Y-m-d
	 *
	 * @return static
	 * @generated
	 */
	public function formatStandardDate(): static
	{
		return $this->new($this->proc->formatStandardDate());
	}


	/**
	 * @alias FluentValueProcessor::formatStandardDate()
	 * @generated
	 */
	public function toStandardDate(): string
	{
		return $this->proc->formatStandardDate();
	}


	/**
	 * Converts value to date format Y-m-d H:i:s
	 *
	 * @return static
	 * @generated
	 */
	public function formatStandardDateTime(): static
	{
		return $this->new($this->proc->formatStandardDateTime());
	}


	/**
	 * @alias FluentValueProcessor::formatStandardDateTime()
	 * @generated
	 */
	public function toStandardDateTime(): string
	{
		return $this->proc->formatStandardDateTime();
	}


	/**
	 * @return static
	 * @generated
	 */
	public function time(): static
	{
		return $this->new($this->proc->time());
	}


	/**
	 * @alias FluentValueProcessor::time()
	 * @generated
	 */
	public function toTimestamp(): string
	{
		return $this->proc->time();
	}


	/**
	 * Wrap current value with html tag
	 *
	 * @example flu('Hello world!')->htmlTag('h1') //<h1>Hello world</h1>
	 * @param  string  $tag
	 * @return static
	 * @generated
	 */
	public function htmlTag(string $tag): static
	{
		return $this->new($this->proc->htmlTag($tag));
	}


	/**
	 * @alias FluentValueProcessor::htmlTag()
	 * @generated
	 */
	public function toHTMLTag(string $tag): string
	{
		return $this->proc->htmlTag($tag);
	}


	/**
	 * Parses the string into variables
	 *
	 * @return static
	 * @generated
	 */
	public function htmlAttributes(): static
	{
		return $this->new($this->proc->htmlAttributes());
	}


	/**
	 * @alias FluentValueProcessor::htmlAttributes()
	 * @generated
	 */
	public function toHTMLAttributes(): string
	{
		return $this->proc->htmlAttributes();
	}


	/**
	 * Parses the string into variables
	 *
	 * @return static
	 * @generated
	 */
	public function htmlToText(): static
	{
		return $this->new($this->proc->htmlToText());
	}


	/**
	 * @alias FluentValueProcessor::htmlToText()
	 * @generated
	 */
	public function toTextFromHTML(): string
	{
		return $this->proc->htmlToText();
	}


	/**
	 * @param  bool  $doubleEncode
	 * @return static
	 * @generated
	 */
	public function escapeHTML(bool $doubleEncode = true): static
	{
		return $this->new($this->proc->escapeHTML($doubleEncode));
	}


	/**
	 * Merge array
	 *
	 * @param  array  ...$array
	 * @return static
	 * @generated
	 */
	public function merge(array ...$array): static
	{
		return $this->new($this->proc->merge(...$array));
	}


	/**
	 * @alias FluentValueProcessor::merge()
	 * @generated
	 */
	public function getMerged(array ...$array): array
	{
		return $this->proc->merge(...$array);
	}


	/**
	 * Run a filter over each of the items.
	 *
	 * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
	 * @return static
	 * @generated
	 */
	public function filter(callable $callback = null): static
	{
		return $this->new($this->proc->filter($callback));
	}


	/**
	 * @alias FluentValueProcessor::filter()
	 * @generated
	 */
	public function getFiltered(callable $callback = null): array
	{
		return $this->proc->filter($callback);
	}


	/**
	 * Rejects items using truth test
	 *
	 * @param  (callable(TKey,TValue): mixed)|null  $callback  - "self::method" or "static::method" will be called Using FluentValue
	 * @return static
	 * @generated
	 */
	public function reject(callable $callback = null): static
	{
		return $this->new($this->proc->reject($callback));
	}


	/**
	 * @alias FluentValueProcessor::reject()
	 * @generated
	 */
	public function getRejected(callable $callback = null): array
	{
		return $this->proc->reject($callback);
	}


	/**
	 * Explodes, then value and then filters out empty values
	 *
	 * @param  string  $separator
	 * @return static
	 * @generated
	 */
	public function explodeRejectEmpty(string $separator): static
	{
		return $this->new($this->proc->explodeRejectEmpty($separator));
	}


	/**
	 * @alias FluentValueProcessor::explodeRejectEmpty()
	 * @generated
	 */
	public function getExplodedEmptyRejected(string $separator): array
	{
		return $this->proc->explodeRejectEmpty($separator);
	}


	/**
	 * Explodes, then trims each value
	 *
	 * @param  string  $separator
	 * @return static
	 * @generated
	 */
	public function explodeTrim(string $separator): static
	{
		return $this->new($this->proc->explodeTrim($separator));
	}


	/**
	 * @alias FluentValueProcessor::explodeTrim()
	 * @generated
	 */
	public function toExplodeTrim(string $separator): array
	{
		return $this->proc->explodeTrim($separator);
	}


	/**
	 * Return the first element in an array passing a given truth test.
	 *
	 * @param  (callable(TKey,TValue): mixed)|null  $callback
	 * @param  null  $default
	 * @return static
	 * @see  Arr::first()
	 * @generated
	 */
	public function first(callable $callback = null, $default = null): static
	{
		return $this->new($this->proc->first($callback, $default));
	}


	/**
	 * @alias FluentValueProcessor::first()
	 * @generated
	 */
	public function getFirst(callable $callback = null, $default = null): mixed
	{
		return $this->proc->first($callback, $default);
	}


	/**
	 * Return the last element in an array passing a given truth test.
	 *
	 * @param  (callable(TKey,TValue): mixed)|null  $callback
	 * @param  null  $default
	 * @return static
	 * @see  Arr::last()
	 * @generated
	 */
	public function last(callable $callback = null, $default = null): static
	{
		return $this->new($this->proc->last($callback, $default));
	}


	/**
	 * @alias FluentValueProcessor::last()
	 * @generated
	 */
	public function getLast(callable $callback = null, $default = null): mixed
	{
		return $this->proc->last($callback, $default);
	}


	/**
	 * Applies the callback to the elements of the given arrays
	 * Closure callable is injectable ex ->edit(\MyClass $value) // will call $editor(MyClass(TValue))
	 * "self::method" or "static::method" will be called Using FluentValue
	 *
	 * @param  (callable(TKey,TValue): mixed)  $callback
	 * @param  mixed  ...$arg  extra arguments passed to callback
	 * @return static
	 * @generated
	 */
	public function map(callable $callback, mixed ...$arg): static
	{
		return $this->new($this->proc->map($callback, ...$arg));
	}


	/**
	 * @alias FluentValueProcessor::map()
	 * @generated
	 */
	public function getMapped(callable $callback, mixed ...$arg): array
	{
		return $this->proc->map($callback, ...$arg);
	}


	/**
	 * Run an associative map over each of the items.
	 * The callback should return an associative array with a single key/value pair.
	 *
	 * @param  (callable(TKey,TValue): mixed)  $callback
	 * @return static
	 * @generated
	 */
	public function mapWithKeys(callable $callback): static
	{
		return $this->new($this->proc->mapWithKeys($callback));
	}


	/**
	 * @alias FluentValueProcessor::mapWithKeys()
	 * @generated
	 */
	public function getMappedWithKeys(callable $callback): array
	{
		return $this->proc->mapWithKeys($callback);
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @generated
	 */
	public function whenOk(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenOk($success, $default));
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @generated
	 */
	public function whenNotOk(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenNotOk($success, $default));
	}


	/**
	 * @param  mixed  $value
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @generated
	 */
	public function when(mixed $value, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->when($value, $success, $default));
	}


	/**
	 * @param  mixed  $value
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @generated
	 */
	public function unless(mixed $value, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->unless($value, $success, $default));
	}


	/**
	 * @param  array|string  $needles
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenContains()
	 * @generated
	 */
	public function whenContains(array|string $needles, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenContains($needles, $success, $default));
	}


	/**
	 * @param  array  $needles
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenContainsAll()
	 * @generated
	 */
	public function whenContainsAll(array $needles, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenContainsAll($needles, $success, $default));
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenEmpty()
	 * @generated
	 */
	public function whenEmpty(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenEmpty($success, $default));
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenNotEmpty()
	 * @generated
	 */
	public function whenNotEmpty(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenNotEmpty($success, $default));
	}


	/**
	 * @param $needles
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenEndsWith()
	 * @generated
	 */
	public function whenEndsWith($needles, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenEndsWith($needles, $success, $default));
	}


	/**
	 * @param $value
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenExactly()
	 * @generated
	 */
	public function whenExactly($value, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenExactly($value, $success, $default));
	}


	/**
	 * @param $value
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenNotExactly()
	 * @generated
	 */
	public function whenNotExactly($value, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenNotExactly($value, $success, $default));
	}


	/**
	 * @param $pattern
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenIs()
	 * @generated
	 */
	public function whenIs($pattern, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenIs($pattern, $success, $default));
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenIsAscii()
	 * @generated
	 */
	public function whenIsAscii(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenIsAscii($success, $default));
	}


	/**
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenIsUuid()
	 * @generated
	 */
	public function whenIsUuid(mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenIsUuid($success, $default));
	}


	/**
	 * @param $needles
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenStartsWith()
	 * @generated
	 */
	public function whenStartsWith($needles, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenStartsWith($needles, $success, $default));
	}


	/**
	 * @param $pattern
	 * @param  mixed  $success
	 * @param  mixed|null  $default
	 * @return static
	 * @see  Stringable::whenTest()
	 * @generated
	 */
	public function whenTest($pattern, mixed $success, mixed $default = null): static
	{
		return $this->new($this->proc->whenTest($pattern, $success, $default));
	}


	/**
	 * Add .$extension to current value
	 *
	 * @param  string  $extension
	 * @return static
	 * @generated
	 */
	public function filename(string $extension): static
	{
		return $this->new($this->proc->filename($extension));
	}


	/**
	 * @alias FluentValueProcessor::filename()
	 * @generated
	 */
	public function toFilename(string $extension): string
	{
		return $this->proc->filename($extension);
	}


	/**
	 * Convert value to path
	 *
	 * @example flu('filename').toFilePath('.txt','/var/www/html') #=> /var/www/html/filename.txt
	 * @example flu('filename').toFilePath('txt','/var/www/html') #=> /var/www/html/filename.txt
	 * @param  string|null  $extension  if null then current value is added
	 * @param  string|null  $root  directory path - If null then / is used
	 * @return static
	 * @generated
	 */
	public function path(string $extension = null, string $root = null): static
	{
		return $this->new($this->proc->path($extension, $root));
	}


	/**
	 * @alias FluentValueProcessor::path()
	 * @generated
	 */
	public function toPath(string $extension = null, string $root = null): string
	{
		return $this->proc->path($extension, $root);
	}


	/**
	 * Return file extension.
	 * If current value is not file then try to get extension manually using string manipulations
	 *
	 * @param  bool  $lowercase
	 * @return static
	 * @generated
	 */
	public function extension(bool $lowercase = false): static
	{
		return $this->new($this->proc->extension($lowercase));
	}


	/**
	 * @alias FluentValueProcessor::extension()
	 * @generated
	 */
	public function toExtension(bool $lowercase = false): string
	{
		return $this->proc->extension($lowercase);
	}
}
