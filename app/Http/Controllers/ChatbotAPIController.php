<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\PlantChatbotConversation;

class ChatbotAPIController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message', '');
        
        if (empty($message)) {
            return response()->json(['message' => 'Please enter a message.']);
        }

        try {
            $botman = app('botman');
            
            // Register conversation
            $botman->hears('.*', function (BotMan $bot) {
                $bot->startConversation(new PlantChatbotConversation());
            });
            
            // Process the message
            $botman->listen();
            
            // Return a success response
            return response()->json(['message' => 'Message processed successfully.']);
        } catch (\Exception $e) {
            \Log::error('Chatbot Error: ' . $e->getMessage());
            return response()->json(
                ['message' => 'Sorry, I encountered an error processing your message.'],
                500
            );
        }
    }

    public function initialize(Request $request)
    {
        return response()->json([
            'message' => '🌱 Welcome to Plant Hub! How can I help you today?',
            'options' => [
                ['text' => '🎯 Get Plant Recommendation', 'value' => 'recommend'],
                ['text' => '❓ Ask About Plant Care', 'value' => 'care'],
                ['text' => '📚 Learn Plant Facts', 'value' => 'facts'],
                ['text' => '🔍 Search Plants', 'value' => 'search'],
            ]
        ]);
    }
}
