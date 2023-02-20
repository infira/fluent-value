<?php 
namespace Infira\FluentValue\Chain;

/**
 * @method FluentChain append(mixed ...$values)
 * @method FluentChain prepend(mixed ...$values)
 * @method FluentChain transform(callable $callback, mixed ...$parameter)
 * @method FluentChain at(string|int $key)
 * @method FluentChain size()
 * @property-read FluentChain $size - transform underlying value using count()/strlen()
 * @method FluentChain strlen()
 * @property-read FluentChain $strlen - Get string length
 * @method FluentChain basename()
 * @property-read FluentChain $basename - Returns trailing name component of path/class-string
 * @method FluentChain urlEncode()
 * @property-read FluentChain $encodedURL - URL-encodes string
 * @method FluentChain implode(string $glue)
 * @method FluentChain join(string $glue)
 * @method FluentChain explode(string $separator)
 * @method FluentChain lines()
 * @property-read FluentChain $lines - Split lines into array
 * @method FluentChain wrap(string|array $before, string|array $after = null)
 * @method FluentChain format(string $format, mixed ...$values)
 * @method FluentChain json(bool $pretty = false)
 * @property-read FluentChain $json - Returns the JSON representation of a value
 * @method FluentChain jsonDecode(?bool $associative = null, int $depth = 512, int $flags = 0)
 * @property-read FluentChain $jsonDecode - Returns the JSON representation of a value
 * @method FluentChain sprintf(mixed ...$values)
 * @method FluentChain vsprintf(mixed $values)
 * @method FluentChain wrapQuotes(string $quotes = '"')
 * @property-read FluentChain $wrapQuotes - Wrap quotes
 * @method FluentChain addSlashes()
 * @property-read FluentChain $slashedString - Quote string with slashes
 * @method FluentChain parseStr()
 * @property-read FluentChain $parsedStr - Parses the string into variables
 * @method string getMatch(string $pattern)
 * @method FluentChain match(string $pattern)
 * @method array getAllMatches(string $pattern)
 * @method FluentChain matchAll(string $pattern)
 * @method FluentChain serialize()
 * @property-read FluentChain $serialized - String representation of object.
 * @method FluentChain unserialize(array $options = [])
 * @property-read FluentChain $unserialized - Constructs the object.
 * @method FluentChain characters(int $length = 1)
 * @property-read FluentChain $characters - transform underlying value characters array
 * @method FluentChain render(array $data = [], callable $renderer = null)
 * @property-read FluentChain $rendered - Simple string templating
 * @method FluentChain md5()
 * @property-read FluentChain $md5 - Get md5 hash
 * @method FluentChain sha1()
 * @property-read FluentChain $sha1 - Get sha1 hash
 * @method FluentChain crc32b()
 * @property-read FluentChain $crc32b - Get crc32b hash
 * @method FluentChain sha512()
 * @property-read FluentChain $sha512 - Get sha512 hash
 * @method float|int toNumeric()
 * @method FluentChain numeric()
 * @property-read FluentChain $numeric
 * @method string toFormattedNumber(string $decimalSeparator = ',', string $thousand = '')
 * @method FluentChain formatNumber(string $decimalSeparator = ',', string $thousand = '')
 * @property-read FluentChain $formattedNumber
 * @method FluentChain negative()
 * @property-read FluentChain $negative
 * @method FluentChain positive()
 * @property-read FluentChain $positive
 * @method FluentChain max(mixed ...$max)
 * @method FluentChain min(mixed ...$max)
 * @method FluentChain floor()
 * @property-read FluentChain $floor
 * @method FluentChain ceil()
 * @property-read FluentChain $ceil
 * @method FluentChain round(int $precision = 0)
 * @property-read FluentChain $round
 * @method FluentChain increment(int $by = 1)
 * @property-read FluentChain $increment
 * @method FluentChain decrement(int $by = 1)
 * @property-read FluentChain $decrement
 * @method FluentChain add(float|int $value)
 * @method FluentChain subtract(float|int $value)
 * @method FluentChain multiply(float|int $value)
 * @method FluentChain divide(float|int $value)
 * @method FluentChain increaseByPercent(float|int $percent)
 * @method FluentChain decreaseByPercent(float|int $percent)
 * @method FluentChain bool()
 * @property-read FluentChain $bool - transform underlying value to bool
 * @method FluentChain int()
 * @property-read FluentChain $int - transform underlying value to integer
 * @method FluentChain float()
 * @property-read FluentChain $float - transform underlying value to float
 * @method FluentChain array()
 * @property-read FluentChain $array - transform underlying value to array
 * @method FluentChain string()
 * @property-read FluentChain $string - transform underlying value to string
 * @method FluentChain type()
 * @property-read FluentChain $type - transform underlying value to variable type
 * @method FluentChain eur(string $decimalSeparator = ',', string $thousand = '')
 * @property-read FluentChain $eur - Format value as number and append € currency sign
 * @method FluentChain dollar(string $decimalSeparator = ',', string $thousand = '')
 * @property-read FluentChain $dollar - Format value as number and append $ currency sign
 * @method FluentChain money(string $currency, string $decimalSeparator = ',', string $thousand = '')
 * @method FluentChain discount(float|int $percent)
 * @method FluentChain markup(float|int $percent)
 * @method FluentChain removeVat(float|int $vatPercent = null)
 * @property-read FluentChain $vatExcluded - FluentValue where VAT(value added tax) is excluded
 * @method FluentChain addVat(float|int $vatPercent = null)
 * @property-read FluentChain $vatIncluded - FluentValue where VAT(value added tax) is included
 * @method FluentChain vat(bool $priceContainsVat, float|int $vatPercent = null)
 * @method FluentChain formatDate(string $format = null)
 * @property-read FluentChain $formatDate - Convert value to date formatted string using $format If $format is not provided getDefaultDateFormat() is used
 * @method FluentChain formatDateTime()
 * @property-read FluentChain $formatDateTime - Convert value to date formatted using getDefaultDateTimeFormat()
 * @method FluentChain formatStandardDate()
 * @property-read FluentChain $formatStandardDate - Converts value to date format Y-m-d
 * @method FluentChain formatStandardDateTime()
 * @property-read FluentChain $formatStandardDateTime - Converts value to date format Y-m-d H:i:s
 * @method FluentChain timestamp()
 * @property-read FluentChain $timestamp
 * @method FluentChain htmlTag(string $tag)
 * @method FluentChain htmlAttributes()
 * @property-read FluentChain $htmlAttributes - Parses the string into variables
 * @method FluentChain htmlToText()
 * @property-read FluentChain $htmlToText - Parses the string into variables
 * @method FluentChain escapeHTML(bool $doubleEncode = true)
 * @property-read FluentChain $escapedHTML
 * @method FluentChain merge(array ...$array)
 * @method array toArrayKeys()
 * @method FluentChain keys()
 * @property-read FluentChain $keys - Get array keys
 * @method FluentChain filter(callable $callback = null)
 * @property-read FluentChain $filter - reject empty
 * @method FluentChain pushTo(string|int $key, mixed ...$values)
 * @method FluentChain push(mixed ...$values)
 * @method FluentChain reject(callable $callback = null)
 * @property-read FluentChain $reject - reject not empty
 * @method FluentChain explodeRejectEmpty(string $separator)
 * @method FluentChain explodeTrim(string $separator)
 * @method FluentChain first(callable $callback = null, $default = null)
 * @property-read FluentChain $first - Return the first element in an array passing a given truth test.
 * @method FluentChain last(callable $callback = null, $default = null)
 * @property-read FluentChain $last - Return the last element in an array passing a given truth test.
 * @method FluentChain map(callable|string|array $callback, mixed ...$arg)
 * @method FluentChain mapMe(string $fluentMethod, mixed ...$arg)
 * @method FluentChain mapWithKeys(callable $callback)
 * @method FluentChain whenOk(mixed $success, mixed $default = null)
 * @method FluentChain whenNotOk(mixed $success, mixed $default = null)
 * @method FluentChain when(mixed $value, mixed $success, mixed $default = null)
 * @method FluentChain unless(mixed $value, mixed $success, mixed $default = null)
 * @method FluentChain whenContains(array|string $needles, mixed $success, mixed $default = null)
 * @method FluentChain whenContainsAll(array $needles, mixed $success, mixed $default = null)
 * @method FluentChain whenEmpty(mixed $success, mixed $default = null)
 * @method FluentChain whenNotEmpty(mixed $success, mixed $default = null)
 * @method FluentChain whenEndsWith($needles, mixed $success, mixed $default = null)
 * @method FluentChain whenExactly($value, mixed $success, mixed $default = null)
 * @method FluentChain whenNotExactly($value, mixed $success, mixed $default = null)
 * @method FluentChain whenIs($pattern, mixed $success, mixed $default = null)
 * @method FluentChain whenIsAscii(mixed $success, mixed $default = null)
 * @method FluentChain whenIsUuid(mixed $success, mixed $default = null)
 * @method FluentChain whenStartsWith($needles, mixed $success, mixed $default = null)
 * @method FluentChain whenTest($pattern, mixed $success, mixed $default = null)
 * @method string toFileName(string $extension)
 * @method FluentChain filename(string $extension)
 * @method string toPath(string $extension = null, string $root = '/')
 * @method FluentChain path(string $extension = null, string $root = '/')
 * @property-read FluentChain $path - Convert value to path
 * @method string toExtension(bool $lowercase = false)
 * @method FluentChain extension(bool $lowercase = false)
 * @property-read FluentChain $extension - Return file extension. If current value is not file then try to get extension manually using string manipulations
 * @method bool fileExists(string $extension = null)
 * @method bool isFile(string $extension = null)
 * @method bool isExtension(string $extension)
 * @property-read FluentChain newLine - Append a new line to the string.
 * @method FluentChain newLine($count = 1) - Append a new line to the string.
 * @property-read FluentChain ascii - Transliterate a UTF-8 value to ASCII.
 * @method FluentChain ascii($language = 'en') - Transliterate a UTF-8 value to ASCII.
 * @property-read FluentChain camel - Convert a value to camel case.
 * @method FluentChain camel() - Convert a value to camel case.
 * @property-read FluentChain dirname - Get the parent directory's path.
 * @method FluentChain dirname($levels = 1) - Get the parent directory's path.
 * @property-read FluentChain kebab - Convert a string to kebab case.
 * @method FluentChain kebab() - Convert a string to kebab case.
 * @property-read FluentChain limit - Limit the number of characters in a string.
 * @method FluentChain limit($limit = 100, $end = '...') - Limit the number of characters in a string.
 * @property-read FluentChain lower - Convert the given string to lower-case.
 * @method FluentChain lower() - Convert the given string to lower-case.
 * @property-read FluentChain markdown - Convert GitHub flavored Markdown into HTML.
 * @method FluentChain markdown(array $options = []) - Convert GitHub flavored Markdown into HTML.
 * @property-read FluentChain inlineMarkdown - Convert inline Markdown into HTML.
 * @method FluentChain inlineMarkdown(array $options = []) - Convert inline Markdown into HTML.
 * @property-read FluentChain plural - Get the plural form of an English word.
 * @method FluentChain plural($count = 2) - Get the plural form of an English word.
 * @property-read FluentChain pluralStudly - Pluralize the last word of an English, studly caps case string.
 * @method FluentChain pluralStudly($count = 2) - Pluralize the last word of an English, studly caps case string.
 * @property-read FluentChain reverse - Reverse the string.
 * @method FluentChain reverse() - Reverse the string.
 * @property-read FluentChain squish - Remove all "extra" blank space from the given string.
 * @method FluentChain squish() - Remove all "extra" blank space from the given string.
 * @property-read FluentChain stripTags - Strip HTML and PHP tags from the given string.
 * @method FluentChain stripTags($allowedTags = null) - Strip HTML and PHP tags from the given string.
 * @property-read FluentChain upper - Convert the given string to upper-case.
 * @method FluentChain upper() - Convert the given string to upper-case.
 * @property-read FluentChain title - Convert the given string to title case.
 * @method FluentChain title() - Convert the given string to title case.
 * @property-read FluentChain headline - Convert the given string to title case for each word.
 * @method FluentChain headline() - Convert the given string to title case for each word.
 * @property-read FluentChain singular - Get the singular form of an English word.
 * @method FluentChain singular() - Get the singular form of an English word.
 * @property-read FluentChain slug - Generate a URL friendly "slug" from a given string.
 * @method FluentChain slug($separator = '-', $language = 'en') - Generate a URL friendly "slug" from a given string.
 * @property-read FluentChain snake - Convert a string to snake case.
 * @method FluentChain snake($delimiter = '_') - Convert a string to snake case.
 * @property-read FluentChain studly - Convert a value to studly caps case.
 * @method FluentChain studly() - Convert a value to studly caps case.
 * @property-read FluentChain trim - Trim the string of the given characters.
 * @method FluentChain trim($characters = null) - Trim the string of the given characters.
 * @property-read FluentChain ltrim - Left trim the string of the given characters.
 * @method FluentChain ltrim($characters = null) - Left trim the string of the given characters.
 * @property-read FluentChain rtrim - Right trim the string of the given characters.
 * @method FluentChain rtrim($characters = null) - Right trim the string of the given characters.
 * @property-read FluentChain lcfirst - Make a string's first character lowercase.
 * @method FluentChain lcfirst() - Make a string's first character lowercase.
 * @property-read FluentChain ucfirst - Make a string's first character uppercase.
 * @method FluentChain ucfirst() - Make a string's first character uppercase.
 * @property-read FluentChain words - Limit the number of words in a string.
 * @method FluentChain words($words = 100, $end = '...') - Limit the number of words in a string.
 */
trait FluentChainIdeHelper
{
}
