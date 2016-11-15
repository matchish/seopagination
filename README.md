# SeoPagination

Blade directives for seo pagination tags
https://support.google.com/webmasters/answer/1663744

## Install

Via Composer

``` bash
$ composer require matchish/seopagination
```
Add to config/app.php

``` php
'providers' => 
...
Matchish\Seopagination\SeoPaginationServiceProvider::class,
...
```

## Usage

### In Controller

``` php
app('seopagination')->setPaginator($posts);
```

in blade view

``` php
@canonical
@metaYandex
@seoPaginationPrev
@seoPaginationNext
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
