<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$H8qYi7hbR40xBpSZ86.03uPHJp5QIpGIU0hctem0OvlMouXh5/T8G', 'remember_token' => '',],
            ['id' => 2, 'name' => 'Matteo', 'email' => 'm.bindi@flamingosoftware.it', 'password' => '$2y$10$ZENKiBVPtOEcVjuOEF5VfegTLbxwaFjF75Pz/nUXo.cAVcipoEaSy', 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
