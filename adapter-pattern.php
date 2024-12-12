<?php

// Provides a method getAmountInEuro() returning a fixed amount
class EuroCurrency
{
    public function getAmountInEuro(): float
    {
        return 100; // amount in Euro
    }
}

// Target Interface: Defines what the client expects
interface CurrencyInUSD
{
    public function getAmountInUSD(): float;
}

// Adapter: Converts Euros to USD
class CurrencyAdapter implements CurrencyInUSD
{
    private EuroCurrency $amountInEuro;

    public function __construct(EuroCurrency $euroSource)
    {
        $this->amountInEuro = $euroSource;
    }

    public function getAmountInUSD(): float
    {
        $amountInEuro = $this->amountInEuro->getAmountInEuro();
        return ($amountInEuro * 1.1); // Conversion formula
    }
}

// Client: Uses the CurrencyInUSD interface to display the amount in USD.
function displayAmount(CurrencyInUSD $amountSource)
{
    echo "Amount: $" . round($amountSource->getAmountInUSD(), 2) . PHP_EOL;
}

// Usage
$amountInEuro = new EuroCurrency();
$adapter = new CurrencyAdapter($amountInEuro);
displayAmount($adapter); // Amount: $110
