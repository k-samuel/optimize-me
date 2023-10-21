[![PHP Version](https://img.shields.io/badge/php-7.4%2B-blue.svg)](https://packagist.org/packages/k-samuel/optimize-me)
[![Total Downloads](https://img.shields.io/packagist/dt/k-samuel/optimize-me.svg?style=flat-square)](https://packagist.org/packages/k-samuel/optimize-me)
[![Build and Test](https://github.com/k-samuel/optimize-me/actions/workflows/php.yml/badge.svg)](https://github.com/k-samuel/optimize-me/actions/workflows/php.yml)

# OptimizeMe Challenge
Code optimization challenge for PHP developers.

PHP modified adaptation.
Based on homework task for Golang educational project with Romanov Vasily “Technosphere Mail.ru Group” at Moscow State University. Lomonosov.


### Introduction

Task for working with the `xdebug` profiler.

There is a Search method that parses the file and displays the necessary data.
It doesn't fast enough. It is necessary to optimize the code of this method.

## Target

Learn to work with xdebug profiler, find hot spots in the code, be able to build a profile
CPU and memory consumption, optimize the code taking this information into account.

## Task

**Using xdebug profile** optimize the search method.
The source code of the method is located in the file [src/Slow/Search.php](src/Slow/Search.php),
the new implementation should be written in the file [src/Fast/Search.php](src/Fast/Search.php).

You can run the benchmark in the root of the project directory `php bench.php`

To complete the task, need to optimize each param:
  - Count (number of starts in 1s):  better then slow * 3
  - Memory (peak RAM consumption):  better then slow / 3
  - Best Time (fastest time for one pass): better then slow / 3
  
## Install

Run `composer create-project k-samuel/optimize-me`


## Benchmark
Run `php bench.php`

Note: Memory consumption statistics accessible only for PHP >= 8.2 


## Expected results
Try to get comparable (or better) results. Please note that performance is highly dependent on your hardware and results may vary.

PHP 8.2 + opcache + JIT, apple M2
|        | Count  | Memory       | Best Time    |
| -----: | -----: | -----------: | -----------: |
| Slow   | 250    | 2,856.453 kb | 0.003882 s.  |
| Fast   | 1536   | 516.797 kb   | 0.000645 s.  |








