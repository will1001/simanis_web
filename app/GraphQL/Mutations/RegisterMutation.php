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


class RegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'register',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Register'));
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
            'nama_direktur' => [
                'name' => 'nama_direktur',
                'type' => Type::nonNull(Type::string()),
            ],
            'no_hp' => [
                'name' => 'no_hp',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $checkNIK = User::where('nik', $args['nik'])->first();

        if ($checkNIK) {
            return  (object)array(
                "messagges" => "NIK sudah Terdaftar"
            );
        }

        $users = new User([
            'id' => (string) Str::uuid()->getHex(),
            'nik' => $args['nik'],
            'password' => Hash::make($args['password']),
        ]);

        $NewBadanUsaha = new BadanUsaha;
        $NewBadanUsaha->id = (string) Str::uuid();
        $NewBadanUsaha->nik = $args['nik'];
        $NewBadanUsaha->nama_direktur = $args['nama_direktur'];
        $NewBadanUsaha->no_hp = $args['no_hp'];

        // BUAT BADAN USAHA
        $NewBadanUsaha->save();

        // BUAT USER
        $users->save();

        return  (object)array(
            "messagges" => "success"
        );
    }
}
