<?php

namespace peczis\pecCms\Console\Commands;

use Illuminate\Console\Command;
use peczis\pecCms\Repositories\Contracts\UserRepositoryInterface;
use peczis\pecCms\Mail\UserCreated;
use Mail;

class UserAddCommand extends Command
{

    /**
     * The console command instance.
     *
     * @var \Illuminate\Console\Command  $command
     */
    protected $command;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pec-cms:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add admin into pec-CMS panel';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $users)
    {
        $this->comment('To complete creating new user we have some questions about him/her from you. Please fill them correctly');

        $name = $this->ask('Name');
        $surname = $this->ask('Surname');

        $login = $name . ' ' . $surname;
        $login = str_replace(' ', '_', $login);
        $login = strtolower(iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $login));

        $email = $this->ask('E-mail address');

        $setupPassword = $this->confirm('You will provide to him/her password? If no we will send him e-mail', true);
        $password = null;

        if ($setupPassword) {
            $password = $this->askPassword();
        } else {
            $password = substr(md5($login), 0, 10);
        }

        if ($users->findBy('email', $email) || $users->findBy('login', $email)) {
            $this->alert('User already exists');
            return true;
        }

        $users->create([
            'name'      =>  $name,
            'surname'   =>  $surname,
            'login'     =>  $login,
            'email'     =>  $email,
            'avatar'    =>  'https://www.gravatar.com/avatar/'. md5($email),
            'password'  =>  bcrypt($password)
        ]);

        if (!$setupPassword) {
            Mail::to($email)->send(new UserCreated($login, $password));
        }

        $this->comment('User has been added.');

        if ($this->confirm('Did you want to add another user to pec-CMS?')) {
            $this->call('pec-cms:admin');
        }

        return true;
    }

    private function askPassword()
    {
        $this->info('Password is secret so just type and hit [enter]');
        $password = $this->secret('Password (at least 8 characters)');

        $passwordConfirmation = $this->secret('Password Confirmation');

        if ($password === $passwordConfirmation && strlen($password) >= 8) {
            return $password;
        } else {
            $this->alert('Password and confirmation doesnt match or dont meet requirements. Try again');
            return $this->askPassword();
        }
    }
}
