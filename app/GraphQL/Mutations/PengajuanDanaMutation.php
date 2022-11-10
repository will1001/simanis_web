<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\PengajuanDana;
use App\Models\BadanUsaha;
use App\Models\Notifikasi;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class PengajuanDanaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'PengajuanDana',
        'model' => PengajuanDana::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('PengajuanDana'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],
            'jumlah_dana' => [
                'name' => 'jumlah_dana',
                'type' => Type::string(),
            ],
            'waktu_pinjaman' => [
                'name' => 'waktu_pinjaman',
                'type' => Type::string(),
            ],
            'alasan' => [
                'name' => 'alasan',
                'type' => Type::nonNull(Type::string()),
            ],
            'instansi' => [
                'name' => 'instansi',
                'type' => Type::nonNull(Type::string()),
            ],
            'jenis_pengajuan' => [
                'name' => 'jenis_pengajuan',
                'type' => Type::string(),
            ],
            'jumlah_dana_bank' => [
                'name' => 'jumlah_dana_bank',
                'type' => Type::string(),
            ],
            'jangka_waktu_bank' => [
                'name' => 'jangka_waktu_bank',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $instansi = User::find($args['instansi']);
        $user = User::find($args["user_id"]);
        $jumlah_dana = null;
        $waktu_pinjaman = null;

        if ($args["jumlah_dana_bank"] != null) {
            $JumlahPinjaman = JumlahPinjaman::find($args["jumlah_dana_bank"]);
            $JangkaWaktu = JangkaWaktu::find($args["jangka_waktu_bank"]);
            $jumlah_dana = $JumlahPinjaman->jumlah;
            $waktu_pinjaman = $JangkaWaktu->waktu;
        } else {
            $jumlah_dana = $args["jumlah_dana"];
            $waktu_pinjaman = $args["waktu_pinjaman"];
        }

        $pengajuanDana = new PengajuanDana([
            'id' => (string) Str::uuid(),
            'id_instansi' => $args["instansi"],
            'user_id' => $args["user_id"],
            'status' => "Menunggu",
            'jumlah_dana' => $jumlah_dana,
            'waktu_pinjaman' => $waktu_pinjaman,
            'alasan' => $args["alasan"],
            'instansi' => $instansi->role,
            'jenis_pengajuan' => $args["jenis_pengajuan"],
        ]);

        $BadanUsaha = BadanUsaha::where('nik', $user->nik)->first();


        $notifikasi = new Notifikasi([
            'id' => (string) Str::uuid(),
            "nik" => "00000000",
            'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
            'user_role' => "ADMIN",
        ]);

        $notifikasi->save();
        if ($instansi == "BANK") {
            $notifikasi = new Notifikasi([
                'id' => (string) Str::uuid(),
                'nik' => "33333333",
                'deskripsi' => "Pembiayaan Usaha dari " . $BadanUsaha->nama_usaha,
                'user_role' => "OJK",
            ]);

            $notifikasi->save();
        }

        $pengajuanDana->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
