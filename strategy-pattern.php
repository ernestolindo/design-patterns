<?php

// Strategy interface

interface SortingStrategy
{
    public function sort(array $data): array;
}

// Concrete strategies

class BubbleSort implements SortingStrategy
{
    function sort(array $data): array
    {
        $length = count($data);
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length - 1; $j++) {
                if ($data[$j] > $data[$j + 1]) {
                    $temp = $data[$j];
                    $data[$j] = $data[$j + 1];
                    $data[$j + 1] = $temp;
                }
            }
        }
        return $data;
    }
}

class SelectionSort implements SortingStrategy
{
    function sort(array $data): array
    {
        $n = count($data);
        for ($i = 0; $i < $n - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($data[$j] < $data[$minIndex]) {
                    $minIndex = $j;
                }
            }
            $temp = $data[$i];
            $data[$i] = $data[$minIndex];
            $data[$minIndex] = $temp;
        }
        return $data;
    }
}

// Create a context

class SortingContext
{
    private SortingStrategy $sortingStrategy;

    public function setSortingStrategy(SortingStrategy $sortingStrategy): void
    {
        $this->sortingStrategy = $sortingStrategy;
    }

    public function sortData(array $data): array
    {
        return $this->sortingStrategy->sort($data);
    }
}

// Using the strategy pattern

$array = [64, 25, 12, 22, 11];
echo "Original array: " . implode(", ", $array) . PHP_EOL;

$sortingContext = new SortingContext();

// Use Bubble Sort
$bubbleSort = new BubbleSort();
$sortingContext->setSortingStrategy($bubbleSort);
echo "Sorted array with Bubble Sort: " . implode(", ", $sortingContext->sortData($array)) . PHP_EOL;

// Use Selection Sort
$selectionSort = new SelectionSort();
$sortingContext->setSortingStrategy($selectionSort);
echo "Sorted array with Selection Sort: " . implode(", ", $sortingContext->sortData($array)) . PHP_EOL;
