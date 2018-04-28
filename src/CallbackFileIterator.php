<?php
declare(strict_types = 1);

namespace kdaviesnz\callbackfileiterator;

/**
 * Class CallbackFileIterator
 * @package kdaviesnz\callbackfileiterator
 */
class CallbackFileIterator
{

    public function run(string $rootDirectory, Callable $callback, bool $recursive, bool $parallel)
    {
        $files = $this->parseFiles($rootDirectory, $recursive);

        if ($parallel) {
            \Amp\Promise\wait(\Amp\ParallelFunctions\parallelMap($files, $callback));
        } else {
            array_walk($files, $callback);
        }

    }

	/**
	 * @param string $currentDirectory
	 * @param bool $recursive
	 */
	private function parseFiles(string $currentDirectory, bool $recursive):array
    {
        $files = [];

	    foreach (new \DirectoryIterator($currentDirectory) as $fileobject) {

	        // Skip if dot.
		    if($fileobject->isDot()) continue;

		    // Skip if directory
		    if ($fileobject->isDir() && $recursive) {
			    $files = array_merge($files, $this->parseFiles($fileobject->getPathname(), $recursive));
		    }

		    if ($fileobject->isFile()) {
                $files[] = $fileobject->getPathname();
		    }
	    }

	    return $files;
    }
}
