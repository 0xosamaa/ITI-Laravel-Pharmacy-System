<?php

function format_price($price)
{
    $price_in_dollars = $price / 100;
    $formatted_price = number_format($price_in_dollars, 2, '.', ',');
    return '$' . $formatted_price;
}
