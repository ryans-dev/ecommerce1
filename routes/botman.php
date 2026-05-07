<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

/**
 * BotMan Routes
 */
$botman = resolve('botman');

// Plant chatbot conversation starter
$botman->hears('hi|hello|hey|plant|help|🌱', function (BotMan $bot) {
    $bot->startConversation(new \App\Conversations\PlantChatbotConversation());
});

// Fallback for any other message
$botman->fallback(function (BotMan $bot) {
    $bot->reply('Sorry, I didn\'t understand that. Try saying "Hi" or "Help" to get started! 🌿');
});
