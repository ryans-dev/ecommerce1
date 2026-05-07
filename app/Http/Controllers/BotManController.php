<?php

namespace App\Http\Controllers;

use App\Conversations\PlantChatbotConversation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    public function askForIntent(BotMan $bot)
    {
        $bot->startConversation(new PlantChatbotConversation());
    }
}
