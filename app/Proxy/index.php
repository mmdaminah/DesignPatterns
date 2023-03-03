<?php

class ReadFile
{
    protected $fileName;
    protected $contents;
    const DOCUMENT_PATH = __DIR__;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function setContents($contents): void
    {
        $this->contents = $contents;
    }

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
        $this->setContents(
            file_get_contents(self::DOCUMENT_PATH . '/' . $this->getFileName())
        );
    }

}

class ReadFileProxy
{
    private $file;

    public function __construct(protected $fileName)
    {
    }

    public function getContents()
    {
        if ($this->file === null) {
            $this->file = new ReadFile($this->getFileName());
        }
        return $this->file->getContents();
    }

    public function getFileName()
    {
        return $this->fileName;
    }

}

$fileOne = new ReadFileProxy('fileOne.txt');
$fileTwo = new ReadFile('fileTwo.txt');

echo $fileOne->getContents();
echo $fileTwo->getContents();
