# CallbackFileIterator

Class that iterators over files and applies a user-defined callback.

Note that using the parallel processing option may not necessarily result in faster times. It all depends on how slow the callback is.

## Install

Via Composer

``` bash
$ composer require kdaviesnz/callbackfileiterator
```

## Usage

``` php

        require_once("vendor/autoload.php");
        require_once("src/CallbackFileIterator.php");

		require_once("src/CallbackFileIterator.php");
		$callback = function() {
			return function(string $filename) {
				echo $filename . "\n";
				sleep (1);
			};
		};

        $callbackIterator = new CallbackFileIterator();
        $recursive = true;
        $parallel = true;

        // Parallel
        $parallelStartTime = \microtime(true);
        $callbackIterator->run(".", $callback(), $recursive, $parallel);
        $parallelEndTime = \microtime(true);

        // Non parallel
        $nonParallelStartTime = \microtime(true);
        $callbackIterator->run(".", $callback(), $recursive, $parallel);
        $nonParallelEndTime = \microtime(true);

        $parallelTime = $parallelEndTime - $parallelStartTime;
        $nonParallelTime = $nonParallelEndTime - $nonParallelStartTime;

        echo "Parallel took $parallelTime ms\n";
        echo "Non parallel took $nonParallelTime ms\n";


```

## Change log

Please see CHANGELOG.md for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see CONTRIBUTING.md and CODE_OF_CONDUCT.md for details.

## Security

If you discover any security related issues, please email kdaviesnz@gmail.com instead of using the issue tracker.

## Credits

- kdaviesnz@gmail.com

## License

The MIT License (MIT). Please see LICENSE.md for more information.

# CallbackFileIterator
