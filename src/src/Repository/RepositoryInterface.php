<?php

namespace Sr\Repository;

interface RepositoryInterface
{
    public function save(array $data, $id = null);
}