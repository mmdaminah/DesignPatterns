<?php

interface Downloader {
    public function download($url);
}

class SimpleDownloader implements Downloader {
    public function download($url)
    {
        echo "Downloading file<br>";
        $result = file_get_contents($url);
        echo "Downloaded bytes: " . strlen($result) . "<br>";

        return $result;
    }
}

class CachingDownloader implements Downloader {
    private $cache = [];
    private $downloader;
    public function __construct(SimpleDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function download($url)
    {
        if(!isset($this->cache[$url])){
            echo "Cache Miss<br>";
            $result = $this->downloader->download($url);
            $this->cache[$url] = $result;
        }
        else {
            echo "CacheProxy HIT. Retrieving result from cache.<br>";
        }
        return $this->cache[$url];
    }
}


function clientCode(Downloader $subject)
{

    $result = $subject->download("fileOne.txt");

    $result = $subject->download("fileOne.txt");

}

echo "Executing client code with real subject:<br>";
$realSubject = new SimpleDownloader();
clientCode($realSubject);

echo "\n";

echo "Executing the same client code with a proxy:<br>";
$proxy = new CachingDownloader($realSubject);
clientCode($proxy);