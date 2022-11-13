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
                'name' => 'kk',
                'type' => Type::nonNull(GraphQL::type('Upload')),
                'rules' => ['required', 'image', 'max:1500'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $filenameKTP = null;
        $filenameKK = null;
        $User = User::find($args['user_id']);
        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
        if (!empty($args['ktp'])) {
            $file = $args['ktp'];
            $extension = $file->getClientOriginalExtension();
            $filenameKTP = $args['user_id'] . '_ktp.' . $extension;

            $file->move(public_path('data_tambahan/'), $filenameKTP);

        }



        if (!empty($args['kk'])) {
            $file = $args['kk'];
            $extension = $file->getClientOriginalExtension();
            $filenameKK = $args['user_id'] . '_kk.' . $extension;

            $file->move(public_path('data_tambahan/'), $filenameKK);

        }



        $data = array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'ktp' => 'data_tambahan/' . $filenameKTP,
            'kk' => 'data_tambahan/' . $filenameKK,
        );
        $DataPendukung = new DataPendukung($data);
        $DataPendukung->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
