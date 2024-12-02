<?php

class Profiler {
    public static function memoryUsage(): int
    {
        return memory_get_usage();
    }

    public static function timeExecution(callable $func) {
        $start = microtime(true);
        $func();
        $end = microtime(true);
        return $end - $start;
    }
}