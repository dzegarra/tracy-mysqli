# MySQLi panel for Tracy

This lib allow you to see all your executed SQL queries when you are using the MySQLi php driver.
It also includes a Bar Panel for Tracy, see the result below.

## Result
![PDO logger with Tracy](https://i.snag.gy/AbESVC.jpg "PDO logger with Tracy")

## Installation
Install it via composer:

`composer require dzegarra/tracy-mysqli`

## How to use

```php
// Create an instance for Tracy Bar Panel
$panel = new \Dzegarra\TracyMysqli\BarPanel();

// Add the panel to Tracy
\Tracy\Debugger::getBar()->addPanel($panel);

// Make a connection to the DB using the \Dzegarra\TracyMysqli\Mysqli class instead of mysqli
$conn = new \Dzegarra\TracyMysqli\Mysqli("hostname", "username", "password", "database");

// Execute your queries
```
## How it works

First you need to add the panel to the Tracy bar. The panel won't be render until the shutdown
process kick in (either way the script ends or you call `die` or `exit`).

Just before the panel start to render the list of all the SQL querys will be fetched from the 
Mysqli class. 

All the queries are store in a static variable in the Mysqli so, no matters how many instances 
of the Mysqli class you create, all the queries of all the instances will be store.

## Inspiration and credits

This repo is based in [filisko/pdo-plus](https://github.com/filisko/pdo-plus).