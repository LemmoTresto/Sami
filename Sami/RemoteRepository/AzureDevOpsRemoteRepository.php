<?php


namespace Sami\RemoteRepository;

class AzureDevOpsRepository extends AbstractRemoteRepository
{
    protected $organisation;

    public function __construct(string $organisation, string $name, string $localPath)
    {
        $this->organisation = $organisation;
        parent::__construct($name, $localPath);
    }

    public function getFileUrl(string $projectVersion, string $relativePath, int $line): string
    {
        $arr = explode('/', $this->name);
        $url = 'https://dev.azure.com/' . $this->organisation . '/' . $arr[0] . '/_git/' . $arr[1] . '?path=' . substr($relativePath, strlen($arr[0]) - 1) . '&version=GB' . $projectVersion;

        if ($line !== null) {
            $url .= '&LINE=' . $line . 'lineStyle=plain&lineEnd=' . ($line + 1) . '&lineStartColumn=1&lineEndColumn=1';
        }

        return $url;
    }
}