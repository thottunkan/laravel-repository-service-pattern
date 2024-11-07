<?php

namespace App\Repositories;

interface EmiRepositoryInterface
{
    public function createEmiDetailsTable($columns);
    public function insertEmiDetails($data);
}
