<?php

class AboutRepository{
    protected $aboutModel;

    public function __construct(AboutModel $aboutModel)
    {
        $this->aboutModel = $aboutModel;
    }
}