<?php

abstract class Product
{
    public string $name;
    protected float $price;
    public static float $income = 0;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getPrice(float $amount = 1): float;

    public function makeBuy(float $amount = 1): void
    {
        self::$income += $this->getPrice($amount);
    }
}

class DigitalProduct extends Product
{
    public function getPrice(float $amount = 1): float
    {
        return $this->price * $amount / 2;
    }
}

class PieceProduct extends Product
{
    public function getPrice(float $amount = 1): float
    {
        return $this->price * $amount;
    }
}

class WeightProduct extends Product
{
    public function getPrice(float $amount = 1): float
    {
        return $this->price * $amount;
    }
}

$digitalProduct = new DigitalProduct("игра", 20);
echo "цена игры " . $digitalProduct->getPrice();
echo '<br>';
echo "цена игр в размере 10 шт: " . $digitalProduct->getPrice(10);
echo '<br>';
echo "покупка 15 игр ";
echo '<br>';
$digitalProduct->makeBuy(15);
echo "покупка 10 игр ";
echo '<br>';
$digitalProduct->makeBuy(10);
echo "общая доходность: " . $digitalProduct::$income;
echo '<br>';
echo '<br>';

$pieceProduct = new PieceProduct("ручка", 20);
echo "цена ручки: " . $pieceProduct->getPrice();
echo '<br>';
echo "цена ручек в размере 10 шт.: " . $pieceProduct->getPrice(10);
echo '<br>';
echo "покупка 10 ручек ";
echo '<br>';
$pieceProduct->makeBuy(10);
echo "покупка 10 ручек ";
echo '<br>';
$pieceProduct->makeBuy(10);
echo "общая доходность: " . $pieceProduct::$income;
echo '<br>';
echo '<br>';

$weightProduct = new WeightProduct("картофель", 20);
echo "цена картофеля за кг: " . $weightProduct->getPrice();
echo '<br>';
echo "цена картофеля за 10.7542 кг: " . $weightProduct->getPrice(10.7542);
echo '<br>';
echo "покупка 10.7542 кг. картофеля ";
echo '<br>';
$weightProduct->makeBuy(10.7542);
echo "общая доходность: " . $weightProduct::$income;

