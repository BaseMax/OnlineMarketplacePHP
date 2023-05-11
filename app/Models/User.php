<?php

namespace App\Models;

use App\Database\User as DatabaseUser;
use App\Exceptions\UserException;
use App\Facades\Response;
use Exception;

class User extends Model
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $remember_token;
    public string $role;
    public string|null $created_at;
    public string|null $updated_at;

    public static function all(): array
    {
        return DatabaseUser::all();
    }

    public static function find(int $id): User|bool
    {
        $user = self::_find($id);

        if ($user) {
            $user = (new User())->load($user);
            return $user;
        }
        return false;
    }

    private static function _find(int $id): array|bool
    {
        $user = (new DatabaseUser())->get_by_id($id);

        return $user;
    }


    public static function findOrFail(int $id): ?User
    {
        try {
            $user = self::find($id);
            return $user;
        } catch (Exception $e) {
            UserException::error($e->getMessage());
            exit;
        }
    }

    private function load(array $user): User
    {
        foreach ($user as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function toString(): array
    {
        return [
            "id"             => $this->id ?? 0,
            "name"           => $this->name,
            "email"          => $this->email,
            "password"       => $this->password,
            "remember_token" => $this->remember_token,
            "role"           => $this->role,
            "created_at"     => $this->created_at,
            "updated_at"     => $this->updated_at
        ];
    }

    public function __toString()
    {
        return Response::json($this->toString());
    }

    public static function destroy(int $id): string
    {
        return DatabaseUser::delete($id);
    }

    public static function update(int $id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            return UserException::error("product not found", 404);
        }
        return DatabaseUser::update($id, $data);
    }
}
