<?php

if (! function_exists('amount_in_words')) {
    function amount_in_words($amount) {
        $formatter = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);

        $amountParts = explode('.', number_format($amount, 2, '.', ''));

        $rupees = (int) $amountParts[0];
        $paise  = isset($amountParts[1]) ? (int) $amountParts[1] : 0;

        $words = ucwords($formatter->format($rupees)) . ' Rupees';

        if ($paise > 0) {
            $words .= ' And ' . ucwords($formatter->format($paise)) . ' Paise';
        }

        return $words . ' Only';
    }
}
