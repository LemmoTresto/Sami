<?php

/*
 * This file is part of the Sami utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sami\RemoteRepository;

abstract class AbstractRemoteRepository
{
    protected $name;
    protected $localPath;

    public function __construct(string $name, string $localPath)
    {
        $this->name = $name;
        $this->localPath = $localPath;
    }

    abstract public function getFileUrl(string $projectVersion, string $relativePath, int $line): string;

    public function getRelativePath($file): string
    {
        $replacementCount = 0;
        $filePath = str_replace($this->localPath, '', $file, $replacementCount);

        if (1 === $replacementCount) {
            return $filePath;
        }

        return '';
    }
}
