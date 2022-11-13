<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\DataPendukung;
use App\Models\BadanUsaha;
use App\Models\Notifikasi;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DataPendukungMutation extends Mutation
{
    protected $attributes = [
        'name' => 'DataPendukung',
        'model' => DataPendukung::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('DataPendukung'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],
            'ktp' => [
                'name' => 'ktp',
                'type' => Type::nonNull(GraphQL::type('Upload')),
                'rules' => ['required', 'image', 'max:1500'],
            ],
            'kk' => [
                'name' => 'waktu_pinjaman',
                'type' => Type::nonNull(GraphQL::type('Upload')),
                'rules' => ['required', 'image', 'max:1500'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // if (!empty($args['foto'])) {
        //     $file = $args['foto'];
        //     $extension = $file->getClientOriginalExtension();
        //     $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
        //     $filename = $BadanUsaha->id . '-' . time() . '.' . $extension;

        //     $file->move(public_path('images/'), $filename);
        //     $data['foto'] = '/images/' . $filename;
        // }

        return  (object)array(
            "messagges" => "success",
        );
    }
}
