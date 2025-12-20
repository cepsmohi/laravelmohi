<?php

use App\Models\App;
use Random\RandomException;

function cusr()
{
    return auth()->user();
}

/**
 * Format numbers in Bangladeshi/Indian grouping:
 * 123456789.5 -> 12,34,56,789.5
 *
 * @param  float|string  $number
 * @param  int|null  $precision  Null = keep existing decimals; e.g., 2 = force 2 decimals
 * @param  bool  $trimTrailingZeros  If true, trims trailing zeros in the fractional part
 * @return string
 */
function bdn(float|string $number, ?int $precision = null, bool $trimTrailingZeros = false): string
{
    // Keep sign, work with absolute value
    $negative = (float) $number < 0;
    $abs = (float) abs($number);

    // If precision specified, round; else keep original decimals
    if ($precision !== null) {
        $normalized = number_format($abs, $precision, '.', ''); // no thousands sep
    } else {
        // Keep native decimals without scientific notation
        // Use a safe upper bound then trim
        $normalized = rtrim(rtrim(sprintf('%.14F', $abs), '0'), '.');
    }

    // Split integer / decimal parts
    $parts = explode('.', $normalized, 2);
    $intPart = $parts[0];
    $decPart = $parts[1] ?? '';

    // Format integer part in BD style: last 3, then groups of 2
    $intFormatted = formatBdInteger($intPart);

    // Handle decimal part
    if ($decPart !== '') {
        if ($trimTrailingZeros) {
            $decPart = rtrim($decPart, '0');
        }
        if ($decPart !== '') {
            $intFormatted .= '.'.$decPart;
        }
    }

    return ($negative ? '-' : '').$intFormatted;
}

/**
 * Helper: format only the integer part with BD/Indian grouping.
 * 123456789 -> 12,34,56,789
 */
function formatBdInteger(string $intPart): string
{
    // Protect non-digit leading (shouldn't occur here), but just in case:
    $intPart = ltrim($intPart, '+');
    if (!ctype_digit($intPart)) {
        // fallback: remove non-digits
        $intPart = preg_replace('/\D+/', '', $intPart) ?? '0';
    }

    $len = strlen($intPart);
    if ($len <= 3) {
        return $intPart;
    }

    $last3 = substr($intPart, -3);
    $rest = substr($intPart, 0, $len - 3);

    $out = '';
    while (strlen($rest) > 2) {
        $out = ','.substr($rest, -2).$out;
        $rest = substr($rest, 0, -2);
    }
    if ($rest !== '') {
        $out = $rest.$out;
    }
    return $out.','.$last3;
}

function bdnw(float $amount): string
{
    // Handle sign
    $negative = $amount < 0;
    $amount = abs($amount);

    // Normalize to 2 decimals safely (avoid float quirks)
    // Example: "1234567.80"
    $normalized = number_format($amount, 2, '.', '');
    [$intStr, $decStr] = explode('.', $normalized);

    $intVal = (int) $intStr; // integer taka
    $decVal = (int) $decStr; // 0..99 poysa

    // Build words
    $takaWords = $intVal === 0 ? 'zero' : bdIntegerToWords($intVal);
    $poysaWords = $decVal === 0 ? '' : bdTwoDigitsToWords($decVal);

    // Assemble phrase
    $phrase = ($negative ? 'minus ' : '');
    $phrase .= $takaWords.' taka';
    if ($poysaWords !== '') {
        $phrase .= ' and '.$poysaWords.' poysa';
    }
    $phrase .= ' only.';

    // Capitalize first letter
    return ucfirst(trim(preg_replace('/\s+/', ' ', $phrase)));
}

/**
 * Convert an integer (0+) to words using Bangladeshi scale:
 * crore, lakh, thousand, hundred, tens/ones.
 */
function bdIntegerToWords(int $n): string
{
    if ($n === 0) {
        return 'zero';
    }

    $parts = [];

    // Break into Indian groupings
    $crore = intdiv($n, 10000000);
    $n %= 10000000; // 1,00,00,000
    $lakh = intdiv($n, 100000);
    $n %= 100000;   // 1,00,000
    $thousand = intdiv($n, 1000);
    $n %= 1000;     // 1,000
    $hundred = intdiv($n, 100);
    $n %= 100;      // 100
    $last = $n;                                   // 0..99

    if ($crore) {
        $parts[] = bdTwoDigitsToWords($crore).' crore';
    }
    if ($lakh) {
        $parts[] = bdTwoDigitsToWords($lakh).' lakh';
    }
    if ($thousand) {
        $parts[] = bdTwoDigitsToWords($thousand).' thousand';
    }
    if ($hundred) {
        $parts[] = bdTwoDigitsToWords($hundred).' hundred';
    }

    if ($last) {
        // If there were hundreds before, use "and" before the last 0–99 chunk
        $parts[] = ($hundred ? 'and ' : '').bdTwoDigitsToWords($last);
    }

    // Join with spaces (no plural "s" for units in currency wording)
    $out = trim(implode(' ', $parts));
    // Clean up any double spaces if present
    return preg_replace('/\s+/', ' ', $out);
}

/**
 * Convert 0..99 to words (English).
 */
function bdTwoDigitsToWords(int $n): string
{
    static $ones = [
        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven',
        8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen'
    ];
    static $tens = [
        2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty', 6 => 'sixty', 7 => 'seventy', 8 => 'eighty',
        9 => 'ninety'
    ];

    if ($n < 20) {
        return $ones[$n];
    }
    $t = intdiv($n, 10);
    $o = $n % 10;
    return $o ? ($tens[$t].' '.$ones[$o]) : $tens[$t];
}


/**
 * @throws RandomException
 */
function randtxt($length = 16)
{
    return bin2hex(random_bytes($length / 2));
}

/**
 * @param  string  $color
 * @return string
 * bg-purple-200 hover:bg-purple-600 dark:bg-purple-600 dark:hover:bg-purple-200 dark:hover:text-black
 * bg-red-200 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-200 dark:hover:text-black
 * bg-green-200 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-200 dark:hover:text-black
 * bg-indigo-200 hover:bg-indigo-600 dark:bg-indigo-600 dark:hover:bg-indigo-200 dark:hover:text-black
 * bg-blue-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-200 dark:hover:text-black
 * bg-orange-200 hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-200 dark:hover:text-black
 * bg-zinc-200 hover:bg-zinc-600 dark:bg-zinc-600 dark:hover:bg-zinc-200 dark:hover:text-black
 * bg-gray-200 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-200 dark:hover:text-black
 * bg-fuchsia-200 hover:bg-fuchsia-600 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-200 dark:hover:text-black
 * bg-rose-200 hover:bg-rose-600 dark:bg-rose-600 dark:hover:bg-rose-200 dark:hover:text-black
 * bg-teal-200 hover:bg-teal-600 dark:bg-teal-600 dark:hover:bg-teal-200 dark:hover:text-black
 * bg-lime-200 hover:bg-lime-600 dark:bg-lime-600 dark:hover:bg-lime-200 dark:hover:text-black
 * bg-yellow-200 hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-200 dark:hover:text-black
 */

function cssbg(string $color = 'gray')
{
    return "bg-$color-200 hover:bg-$color-600 dark:bg-$color-600 dark:hover:bg-$color-200 dark:hover:text-black";
}

function monthname($no)
{
    $months = ['Err', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return $months[$no] ?? 'Err';
}
