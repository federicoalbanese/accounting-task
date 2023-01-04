<?php

namespace Tests;

use App\Models\User;

trait UserHelperTrait
{
    public string $email = 'test@test.com';

    public string $name = 'test';

    public string $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password;

    /**
     * @return \App\Models\User
     */
    public function getUser(): User
    {
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->save();

        return $user->refresh();
    }
}