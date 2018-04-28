<?php

namespace kdaviesnz\callbackfileiterator;

require_once("vendor/autoload.php");

class CallbackFileIteratorTest extends \PHPUnit_Framework_TestCase {

	public function testMethodName() {

		// $this->assertTrue( false, "true didn't end up being false!" );
		require_once("src/CallbackFileIterator.php");
		$callback = function() {
			return function(string $filename) {
				echo $filename . "\n";
				sleep (1);
			};
		};

        $callbackIterator = new CallbackFileIterator();

        // Parallel
        $parallelStartTime = \microtime(true);
        $callbackIterator->run(".", $callback(), false, true);
        $parallelEndTime = \microtime(true);

        // Non parallel
        $nonParallelStartTime = \microtime(true);
        $callbackIterator->run(".", $callback(), false, false);
        $nonParallelEndTime = \microtime(true);

        $parallelTime = $parallelEndTime - $parallelStartTime;
        $nonParallelTime = $nonParallelEndTime - $nonParallelStartTime;

        echo "Parallel took $parallelTime ms\n";
        echo "Non parallel took $nonParallelTime ms\n";

    }

}
