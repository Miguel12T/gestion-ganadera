<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Models\User;
use App\Models\User as EloquentUser;

class AuthRepository implements AuthRepositoryInterface
{
    public function createUser(array $data): User
    {
        return EloquentUser::create($data);
    }

    public function findUserByEmail(string $email): ?User
    {
        return EloquentUser::where('email', $email)->first();
    }
}
?>
