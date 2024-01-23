<?php
function numberToWords($num) {
    $ones = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine'
    );

    $teens = array(
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen'
    );

    $tens = array(
        1 => 'Ten',
        2 => 'Twenty',
        3 => 'Thirty',
        4 => 'Forty',
        5 => 'Fifty',
        6 => 'Sixty',
        7 => 'Seventy',
        8 => 'Eighty',
        9 => 'Ninety'
    );

    $suffixes = array(
        '' => '',
        3 => 'Thousand',
        6 => 'Million',
        9 => 'Billion',
        12 => 'Trillion'
        // Add more suffixes as needed
    );

    $num = (int) $num;
    $output = '';

    if ($num < 10) {
        $output = $ones[$num];
    } elseif ($num < 20) {
        $output = $teens[$num];
    } elseif ($num < 100) {
        $tensDigit = floor($num / 10);
        $onesDigit = $num % 10;
        $output = $tens[$tensDigit];
        if ($onesDigit > 0) {
            $output .= ' ' . $ones[$onesDigit];
        }
    } elseif ($num < 1000) {
        $hundredsDigit = floor($num / 100);
        $tensAndOnes = $num % 100;
        $output = $ones[$hundredsDigit] . ' Hundred';
        if ($tensAndOnes > 0) {
            $output .= ' and ' . numberToWords($tensAndOnes);
        }
    } else {
        foreach (array_keys($suffixes) as $suffixIndex) {
            $nextSuffixIndex = $suffixIndex + 3;
            if ($nextSuffixIndex > strlen($num)) break;
            $nextChunk = substr($num, -$nextSuffixIndex, 3);
            if ($nextChunk > 0) {
                $output = numberToWords($nextChunk) . ' ' . $suffixes[$suffixIndex] . ' ' . $output;
            }
        }
        $lastChunk = substr($num, -strlen($num) % 3);
        if ($lastChunk > 0) {
            $output = numberToWords($lastChunk) . ' ' . $suffixes[strlen($num) - strlen($lastChunk)] . ' ' . $output;
        }
    }

    return $output;
}
?>