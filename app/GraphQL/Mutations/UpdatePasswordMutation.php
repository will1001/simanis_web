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


class UpdatePasswordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdatePassword',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('UpdatePassword'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'old_password' => [
                'name' => 'old_password',
                'type' => Type::nonNull(Type::string()),
            ],
            'new_password' => [
                'name' => 'new_password',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $users = User::find($args["id"]);
        // dd('/member'.$pages.'/settingAkun');

        if (Hash::check($args["old_password"], $users->password)) {
            // dd("true");
            // if ($pages === "member") {
            //     $BadanUsaha = BadanUsaha::where("nik", $users->nik)->first();
            //     $BadanUsaha->email =  $r->input("email");
            //     $BadanUsaha->save();
            // }
            $users->password =  Hash::make($args["new_password"]);

            $users->save();

            return  (object)array(
                "messagges" => "Password Berhasil Dirubah"
            );
        }
        return  (object)array(
            "messagges" => "Password Lama Salah"
        );
    }
}
