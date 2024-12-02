<?php

require_once 'src/avl_tree.php';
require_once 'src/profiler.php';

$tree = new AVLTree();
$root = null;

$numInsertions = 100000;
$numSearches   = 50000;
$numDeletions  = 30000;

$insertKeys = array_map(fn() => rand(1, 1000000), range(1, $numInsertions));
$searchKeys = array_slice($insertKeys, 0, $numSearches);
$deleteKeys = array_slice($insertKeys, 0, $numDeletions);

$startMemory = Profiler::memoryUsage();

$insertTime = Profiler::timeExecution(function () use (&$root, $tree, $insertKeys) {
    foreach ($insertKeys as $key) {
        $root = $tree->insert($root, $key);
    }
});
echo "Insert completed in {$insertTime} seconds.\n";

$searchTime = Profiler::timeExecution(function () use (&$root, $tree, $searchKeys) {
    foreach ($searchKeys as $key) {
        $tree->search($root, $key);
    }
});
echo "Search completed in {$searchTime} seconds.\n";

$deleteTime = Profiler::timeExecution(function () use (&$root, $tree, $deleteKeys) {
    foreach ($deleteKeys as $key) {
        $root = $tree->delete($root, $key);
    }
});
echo "Delete completed in {$deleteTime} seconds.\n";

$endMemory = Profiler::memoryUsage();

$memoryUsage = $endMemory - $startMemory;

$results = <<<EOT
Insert Time: {$insertTime}s
Search Time: {$searchTime}s
Delete Time: {$deleteTime}s
Memory Usage: " . $memoryUsage . " bytes
EOT;

file_put_contents("results/profiling_results.txt", $results);

echo "Results saved to profiling_results.txt.\n";