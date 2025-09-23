<?php

namespace App\Domain\Repositories;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function createUser(array $data): User;
    public function findUserByEmail(string $email): ?User;
}

?>
