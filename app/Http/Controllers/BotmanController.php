<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Controllers\Blogs;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use tests\Browser\ExampleTest;

use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use App\Blog;
use App\Category;
use App\User;
use Auth;
use DB;
use Storage;
use Image;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;


class BotmanController extends Controller
{
    public function handle()
    {
        $botman = app('botman');
  
        $botman->hears('{message}', function($botman, $message) {
  
            if ($message == 'hi') {
                $this->askName($botman);
            }
            else if ($message == 'Create'){
                $botman->reply("Enter URL in browser to Visit : http://127.0.0.1:8000/blogs/create");
            }
            else if ($message == 'Logout'){
                $botman->reply("Enter URL in browser to Visit : http://127.0.0.1:8000/logout");
            }
            else if ($message == 'Blogs'){
                $botman->reply("Enter URL in browser to Visit : http://127.0.0.1:8000/blogs");
            }
            else{
                $botman->reply("Try Typing something like 'Create' or 'Logout' or 'Blogs'");
            } 
  
        });
  
        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Nice to meet you '.$name);
        });
    }
}

?>
