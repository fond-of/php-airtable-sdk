# [Discontinued] Airtable SDK for PHP
**This repository is discontinued without any replacement.**

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fond-of/php-airtable-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fond-of/php-airtable-sdk/?branch=master)

The Airtable SDK for PHP allows you to read and write data to Airtable via API. 
The library comes with a single dependency which is Guzzle 6.x.

## Installation

The SDK can be installed via composer:

```bash
composer require fond-of/php-airtable-sdk
```

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use FondOf\Airtable\{Table, Airtable};

$base = 'baseId';
$table = 'tableId';

$client = (new Airtable([
   'apiKey' => '1234567'
]))->createApiClient();

$table = new Table($client, $base, $table);
```

**Read a single record**
```php
$record = $table->getRecord($recordId);
```

**Read multiple records**
```php
$records = $table->getRecords();
```

**Write a record**
```php
$fields = [
    'Name' => 'Foobar',
    'Notes' => 'This is an example',
    'Attachments' => [
        [
        'url' => 'https://foobar.jpg',
        'filename' => 'Example'
        ],
    ]
];

$table->writeRecord($fields);
```

**Increase record limit(Defaults to 10)**
```php
$records = $table->limit(50)->getRecords();
```
_max limit is 100_

**Change table or base**  
You don't need to create a new table in order to access another table or base. There are two options 
to change them one is via setter function and the other option is a fluent api.

```php
$records = $table->base('baseId')->table('tableId')->getRecords();

$table = $table->setBase('baseId');
$table = $table->setTable('tableId');
$records = $table->getRecords();
```

## Contributing
Feel free to open issues    and pull requests. 

To run tests and code sanatizer you can run the following:  
```bash
make grumphp
```

If you would like to run only tests use:   
```bash
make codeception
```

## License
Please see the [license file](https://github.com/fond-of/php-airtable-sdk/blob/master/LICENSE) for more information.
