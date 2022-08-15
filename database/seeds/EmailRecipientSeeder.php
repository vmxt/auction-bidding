<?php

use Illuminate\Database\Seeder;

class EmailRecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\EmailRecipient::create([
            'name' => 'WSI Demo',
            'email' => 'wsiprod.demo@gmail.com'
        ]);
    }
}
