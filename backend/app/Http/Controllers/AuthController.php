<?php
  namespace App\Http\Controllers;

  use App\Aplication\Services\AuthService;
  use App\Http\Requests\LoginRequest;
  use Illuminate\Http\Request;

  class AuthController extends Controller
  {
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login(
            $request->email,
            $request->password
        );

        if (!$token) {
          return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function register(Request $request)
    {
      $token = $this->authService->register($request->all());
      return response()->json(['token' => $token], 201);
    }
  }
?>
