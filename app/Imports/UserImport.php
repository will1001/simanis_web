<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel
{
    // /**
    //  * @param array $row
    //  *
    //  * @return UserNew|null
    //  */

    public function model(array $row)
    {
        return new User([
            'id' => (string) Str::uuid(),
            'nik'     => $row[0],
            'role' => "IKM",
            'password' => Hash::make("12345678"),
        ]);
    }
}
