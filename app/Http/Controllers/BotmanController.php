<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use App\Blog;
use App\Category;
use App\User;
use Auth;
use DB;
use Storage;
use Image;


class BotmanController extends Controller
{
    public function handle()
    {
        $botman = app('botman');
  
        $botman->hears('{message}', function($botman, $message) {
  
            if ($message == 'hi') {
                $this->askName($botman);
            }
            else if ($message == 'create'){
                $botman->reply("");
            }
            else{
                $botman->reply("Try Typing something like 'Create Blog' or 'Show my Profile' or 'Logout");
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
