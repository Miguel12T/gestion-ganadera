<?php

namespace App\Aplication\Services;

use App\Domain\Repositories\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data): string
    {
      $data['password'] = Hash::make($data['password']);
      $user = $this->authRepository->createUser($data);
      return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(string $email, string $password): ?string
    {
      $user = $this->authRepository->findUserByEmail($email);
      if (!$user || !Hash::check($password, $user->password))
        return null;
      return $user->createToken('auth_token')->plainTextToken; // Usando Sanctum
    }
}

?>
