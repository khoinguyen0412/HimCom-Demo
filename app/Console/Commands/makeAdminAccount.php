<?php

namespace App\Console\Commands;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class makeAdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $adminExists = Admin::where('name','admin')->exists();

        if (!$adminExists){
            $admin = new Admin();
            $admin->name = 'admin';
            $admin->email = 'admin@gmail.com';
            $admin->password = Hash::make('adminpass');
            $admin->save();
            $this->info('Created admin account');
        }
        else{
            $this->error('Admin account already exists');
        }
    }
}
