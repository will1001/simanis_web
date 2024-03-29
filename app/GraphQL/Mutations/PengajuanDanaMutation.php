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
use App\Models\SimulasiAngsuran;

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
                'type' => Type::string(),
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

        $PengajuanDana = PengajuanDana::where('user_id', $args["user_id"])->first();

        if ($PengajuanDana != null && $PengajuanDana->status != "Lunas") {
            if ($PengajuanDana->status == "Menunggu") {
                return  (object)array(
                    "messagges" => "Anda Harus Menunggu 14 Hari Untuk Mengajukan Pembiayaan Lagi",
                );
            } else {
                return  (object)array(
                    "messagges" => "Anda Memiliki Pinjaman yang Sedang Aktif",
                );
            }
        } else {

            $SimulasiAngsuran = SimulasiAngsuran::where('id_jml_pinjaman', $args["jumlah_dana_bank"])
                ->where('id_jangka_waktu', $args["jangka_waktu_bank"])
                ->first();
            if ($SimulasiAngsuran == null) {
                    return  (object)array(
                        "messagges" => "Angsuran Tidak Tersedia,Silahkan Pilih Angsuran yang Lain",
                    );
            } else {
                if ($SimulasiAngsuran->angsuran == "") {
                    return  (object)array(
                        "messagges" => "Angsuran Tidak Tersedia,Silahkan Pilih Angsuran yang Lain",
                    );
                }
                if ($args["jumlah_dana_bank"] != "null") {
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
    }
}
