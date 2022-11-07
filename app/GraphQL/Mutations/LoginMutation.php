<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\BadanUsaha;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'login',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Login'));
    }

    public function args(): array
    {
        return [
            'nik' => [
                'name' => 'nik',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $nik = $args['nik'];
        $password = $args['password'];
        $user = User::where('nik', $nik)->get();
        if (!$user->isEmpty()) {
            $checkPassword = Hash::check($password, $user[0]->password);
            if (!$checkPassword) {
                return  (object)array(
                    "messagges" => "password salah"
                );
            }
        } else {
            return  (object)array(
                "messagges" => "NIK Tidak Terdaftar, Silahkan Klik Daftar Terlebih Dahulu"
            );
        }

        if ($user[0]->status == "Tidak Aktif") {
            return  (object)array(
                "messagges" => "Akun Anda Di Non Aktifkan"
            );
        }

        return  (object)array(
            "id" => $user[0]->id,
            "messagges" => "success",
        );
    }
}
