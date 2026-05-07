<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\Product;

class PlantChatbotConversation extends Conversation
{
    protected $plantData = [];

    public function run()
    {
        // Welcome message
        $this->say('🌱 Welcome to Plant Hub! How can I help you today?');

        // Ask for first input
        $this->ask('Please type your question or request:', function (Answer $answer) {
            $this->processUserInput($answer);
        });
    }

    protected function processUserInput(Answer $answer)
    {
        $input = strtolower($answer->getText());

        if ($this->matchesKeywords($input, ['recommend', 'suggest', 'which plant', 'best plant', 'help me choose', 'for me'])) {
            $this->startRecommendationFlow();
        } elseif ($this->matchesKeywords($input, ['care', 'how to', 'watering', 'light', 'humidity', 'tips', 'help with'])) {
            $this->showCareOptions();
        } elseif ($this->matchesKeywords($input, ['fact', 'learn', 'know', 'tell me', 'interesting', 'about plants'])) {
            $this->sharePlantFacts();
        } elseif ($this->matchesKeywords($input, ['search', 'find', 'show', 'browse', 'monstera', 'pothos', 'snake', 'zz', 'products', 'plants'])) {
            $this->showSearchOptions();
        } else {
            $this->askForIntent();
        }
    }

    protected function matchesKeywords($text, $keywords)
    {
        foreach ($keywords as $keyword) {
            if (strpos($text, strtolower($keyword)) !== false) {
                return true;
            }
        }
        return false;
    }

    protected function askForIntent()
    {
        $this->say('🌱 Welcome to Plant Hub! How can I help you today?');

        $this->ask('Choose an option:', [
            ['text' => '🌿 Get Recommendation', 'value' => 'recommend'],
            ['text' => '💧 Plant Care', 'value' => 'care'],
            ['text' => '📖 Fun Facts', 'value' => 'facts'],
            ['text' => '🔍 Search Plants', 'value' => 'search'],
        ], function (Answer $response) {
            $this->handleIntent($response);
        });
    }

    protected function startRecommendationFlow()
    {
        $this->say('Let\'s find the perfect plant for you!');

        $this->ask('Where will you keep the plant?', [
            ['text' => '🌑 Low Light (Apartment)', 'value' => 'low'],
            ['text' => '🌤 Medium Light (House)', 'value' => 'medium'],
            ['text' => '☀️ High Light (Bright)', 'value' => 'high'],
        ], function (Answer $response) {
            $this->plantData['light'] = $response->getValue();
            $this->askExperience();
        });
    }

    protected function askExperience()
    {
        $this->ask('What\'s your experience level?', [
            ['text' => '🌱 Beginner', 'value' => 'beginner'],
            ['text' => '🌿 Intermediate', 'value' => 'intermediate'],
            ['text' => '🌳 Expert', 'value' => 'expert'],
        ], function (Answer $response) {
            $this->plantData['experience'] = $response->getValue();
            $this->askMaintenance();
        });
    }

    protected function askMaintenance()
    {
        $this->ask('How much time can you dedicate?', [
            ['text' => '🕒 Low (Monthly)', 'value' => 'low'],
            ['text' => '⏰ High (Daily)', 'value' => 'high'],
        ], function (Answer $response) {
            $this->plantData['maintenance'] = $response->getValue();
            $this->provideRecommendation();
        });
    }

    protected function provideRecommendation()
    {
        $light = $this->plantData['light'] ?? 'medium';
        $experience = $this->plantData['experience'] ?? 'beginner';
        $maintenance = $this->plantData['maintenance'] ?? 'medium';

        $recommendation = $this->getRecommendedPlant($light, $experience, $maintenance);
        $productLink = $recommendation['id'] ? route('product.show', $recommendation['id']) : route('shop.index');

        $this->say("🌟 Perfect Match for You!\n\n"
            . "*{$recommendation['name']}*\n"
            . "_{$recommendation['description']}_\n\n"
            . "*Benefits:*\n"
            . "- {$recommendation['benefit1']}\n"
            . "- {$recommendation['benefit2']}\n"
            . "- {$recommendation['benefit3']}\n\n"
            . "*Price:* \${$recommendation['price']}\n\n"
            . "View Product: {$productLink}");

        $this->ask('Would you like to continue?', [
            ['text' => '🔄 Ask Another Question', 'value' => 'continue'],
            ['text' => '❌ End Chat', 'value' => 'end'],
        ], function (Answer $response) {
            if ($response->getValue() === 'continue') {
                $this->askForIntent();
            } else {
                $this->say('Thanks for chatting! Happy planting! 🌱');
            }
        });
    }

    // Care, Search, Facts methods follow the same pattern:
    // - Use $this->say() for output
    // - Use $this->ask(..., function(Answer $response) { ... }); for input
    // - Remove all ->then() calls
}
