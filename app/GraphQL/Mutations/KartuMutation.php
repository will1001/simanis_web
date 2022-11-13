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


class KartuMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Kartu',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Kartu'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],
            'foto' => [
                'name' => 'foto',
                'type' => Type::nonNull(GraphQL::type('Upload')),
                'rules' => ['required', 'image', 'max:1500'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $filename = null;
        $User = User::find($args['user_id']);


        if (!empty($args['foto'])) {
            $file = $args['foto'];
            $extension = $file->getClientOriginalExtension();
            $filename = $args['user_id'] . '.' . $extension;

            $file->move(public_path('/images/'), $filename);
            // $data['foto']= 'images/'.$filename;

        }
        // dd($data);




        $User->foto = 'images/' . $filename;

        // BUAT produk
        $User->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
