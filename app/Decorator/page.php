<?php

interface Page
{
    public function getTitle();
}

class BasePage implements Page
{
    public $title = "";


    public function getTitle()
    {
        return $this->title;
    }
}

abstract class TitleDecorator implements Page
{
    protected Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getTitle()
    {
        return $this->page->getTitle();
    }
}

class HomePage extends TitleDecorator
{
    public function getTitle()
    {
        return $this->page->getTitle() . "/HomePage";
    }
}

class AboutPage extends TitleDecorator
{
    public function getTitle()
    {
        return $this->page->getTitle() . "/AboutPage";
    }
}

$page = new AboutPage(new HomePage(new BasePage()));
echo $page->getTitle();