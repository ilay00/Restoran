<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use App\User;
class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:role {role} {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assingns role to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
             $slug=$this->argument('role');
             $role=Role::where('slug',$slug)->first();
             if (!$role)
             {
                 $this->error("Invalid role $role");
             }
             $userId=$this->argument('userId');
             $user=User::where('id',$userId)->first();
             if(!$user){
             
                 $this->error("Invalid User ID $userId");
             }
             $user->roles()->attach($role);
             $this->info("User ID:$userId now has role $slug");
            } catch(\Exception $exception){
                 $this->error($exception->getMessage());
             

        }
    }
}
