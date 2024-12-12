<?php

// Step 1: Define the Product Interface
interface Log
{
    function getMessage(string $content): string;
}

// Step 2: Implement Concrete Products: ErrorLog, WarningLog, and InfoLog

class ErrorLog implements Log
{
    function getMessage(string $content): string
    {
        return "[" . date('Y-m-d H:i:s') . "] [Error] " . $content . PHP_EOL;
    }
}

class WarningLog implements Log
{
    function getMessage(string $content): string
    {
        return "[" . date('Y-m-d H:i:s') . "] [Warning] " . $content . PHP_EOL;
    }
}

class InfoLog implements Log
{
    function getMessage(string $content): string
    {
        return "[" . date('Y-m-d H:i:s') . "] [Info] " . $content . PHP_EOL;
    }
}

// Step 3: Define the Abstract Creator

abstract class LogFactory
{
    abstract function createLog(): Log;

    public function getLogInfo(string $content): string
    {
        return "New log: " . $this->createLog()->getMessage($content);
    }
}

// Step 4: Implement Concrete Creators

class ErrorLogFactory extends LogFactory
{
    function createLog(): Log
    {
        return new ErrorLog();
    }
}

class WarningLogFactory extends LogFactory
{
    function createLog(): Log
    {
        return new WarningLog();
    }
}

class InfoLogFactory extends LogFactory
{
    function createLog(): Log
    {
        return new InfoLog();
    }
}

// Step 5: Client Code
function clientCode(LogFactory $factory, string $content)
{
    echo $factory->getLogInfo($content);
}

// Example Usage
clientCode(new ErrorLogFactory(), "The software is not recognized"); // Output: New log: [Error] The software is not recognized
clientCode(new WarningLogFactory(), "The software is not updated"); // Output: New log: [Warning] The software is not updated
clientCode(new InfoLogFactory(), "The software is running"); // New log: [Info] The software is running