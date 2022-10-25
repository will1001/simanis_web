<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Webpatser\Uuid\Uuid;
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
            'id' => Uuid::generate(),
            'nik'     => $row[0],
            'role' => "IKM",
            'password' => Hash::make("12345678"),
        ]);
    }
}
