<?php

class AdLoader
{
    public function __construct(private AdRepository $ad_repository) {}

    public function execute() : array {
        return $this->ad_repository->find_all();
    }
}