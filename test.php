<?php

require __DIR__ . '/vendor/autoload.php';

use Sami\Parser\Filter\TrueFilter;
use Sami\RemoteRepository\AzureDevOpsRemoteRepository;
use Sami\Sami;
use Sami\Version\Version;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->in($dir = __DIR__ . '/Sami');

//$versions = GitVersionCollection::create($dir)
//->add('master', 'Origin Master');
$versions = new Version('master');

return new Sami($iterator, [
    'title' => ' API',
    'versions' => $versions,
    'build_dir' => __DIR__ . '/build/%version%',
//    'cache_dir' => __DIR__.'/cache/%version%',
    'default_opened_level' => 2,
    'remote_repository' => new AzureDevOpsRemoteRepository('re-software', 'Internals/origin', dirname($dir)),
    'filter' => new TrueFilter(),
]);