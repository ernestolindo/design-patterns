<?php

interface Pizza
{
    public function getDescription(): string;
    public function getCost(): float;
}

class BasicPizza implements Pizza
{
    public function getDescription(): string
    {
        return "Basic Dough";
    }

    public function getCost(): float
    {
        return 5.0;
    }
}

abstract class PizzaDecorator implements Pizza
{
    protected Pizza $pizza;

    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    // Shared logic for description
    public function getDescription(): string
    {
        return $this->pizza->getDescription() . $this->getDecoratorDescription();
    }

    // Shared logic for cost
    public function getCost(): float
    {
        return $this->pizza->getCost() + $this->getDecoratorCost();
    }

    // Abstract methods for custom behavior
    abstract protected function getDecoratorDescription(): string;
    abstract protected function getDecoratorCost(): float;
}

class CheeseDecorator extends PizzaDecorator
{
    private const COST = 1.5;

    protected function getDecoratorDescription(): string
    {
        return ", Cheese";
    }

    protected function getDecoratorCost(): float
    {
        return self::COST;
    }
}

class PepperoniDecorator extends PizzaDecorator
{
    private const COST = 2;

    protected function getDecoratorDescription(): string
    {
        return ", Pepperoni";
    }

    protected function getDecoratorCost(): float
    {
        return self::COST;
    }
}

class MushroomsDecorator extends PizzaDecorator
{
    private const COST = 1;

    protected function getDecoratorDescription(): string
    {
        return ", Mushrooms";
    }

    protected function getDecoratorCost(): float
    {
        return self::COST;
    }
}

$pizza = new BasicPizza();
$pizzaWithCheese = new CheeseDecorator($pizza);
$pizzaWithCheeseAndPepperoni = new PepperoniDecorator($pizzaWithCheese);

echo $pizzaWithCheeseAndPepperoni->getDescription() . PHP_EOL; // Outputs: "Basic Dough, Cheese, Pepperoni"
echo $pizzaWithCheeseAndPepperoni->getCost() . PHP_EOL;        // Outputs: 8.50
