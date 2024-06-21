<?php

namespace App;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findByEmail(string $email);
}
