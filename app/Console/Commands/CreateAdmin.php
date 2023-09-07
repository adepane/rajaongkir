<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function checkPass()
    {
        $password = $this->secret('Enter password ');
        $confirmPassword = $this->secret('Confirm password ');
        if ($password != $confirmPassword) {
            $this->line('Your Password Not Match');
            $this->line('=======================');

            return $this->checkPass();
        }

        return $password;

    }

    public function checkUser()
    {
        $user['email'] = $this->ask('Enter Email');
        $validator = Validator::make($user, [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $this->line('Email is not valid');
            $this->line('=======================');

            return $this->checkUser();
        }

        $getUser = User::where('email', $user['email'])->get();
        if (count($getUser) > 0) {
            $this->line('Email already exists');
            $this->line('=======================');

            return $this->checkUser();
        }

        return $user['email'];
    }

    public function handle()
    {
        $fullname = $this->ask('Enter name ');
        $email = $this->checkUser();
        $password = $this->checkPass();
        if ($this->confirm('Are You Sure Make This User ?'."\n".'Name : '.$fullname."\n".'Email : '.$email."\n".'Password : As you set')) {
            User::create([
                'name' => $fullname,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info('Your Account Has Been Created.');
        }
    }
}
