# 🌿 Plant Hub Chatbot Documentation

## Overview

The Plant Hub Chatbot is a conversational AI assistant that helps users:
- **Get plant recommendations** based on their living situation and experience level
- **Ask about plant care** with detailed guides for popular plants
- **Learn plant facts** with interesting information about plants
- **Search for plants** by category and features

## Features

### 1. Plant Recommendations 🎯
The chatbot asks users about their:
- Living situation (apartment, house, bright space)
- Experience level (beginner, intermediate, expert)
- Available time for maintenance (minimal, moderate, high)

Based on responses, it recommends suitable plants with:
- Plant name and description
- Care tips (lighting, watering, humidity)
- Price information
- Option to add to cart

### 2. Plant Care Advice ❓
Users can ask about care instructions for:
- Monstera
- Snake Plant
- Pothos
- ZZ Plant

Provides detailed care guides including:
- Watering schedule
- Light requirements
- Temperature range
- Humidity levels
- Pro tips

### 3. Plant Facts 📚
The chatbot shares interesting plant facts including:
- Air quality benefits
- Productivity improvements
- Natural air purification
- Plant growth records
- Photosynthesis details

### 4. Plant Search 🔍
Browse plants by categories:
- Air-purifying plants
- Pet-safe plants
- Low-light plants
- Succulents & Cacti

## Architecture

### Files Created

```
app/
├── Conversations/
│   └── PlantChatbotConversation.php     # Main conversation logic
├── Http/
│   ├── Controllers/
│   │   └── BotManController.php         # BotMan controller
│   └── Middleware/
│       └── RegisterBotManConversations.php
└── ...

config/
└── botman.php                            # BotMan configuration

resources/views/components/chatbot/
└── widget.blade.php                      # Chatbot UI widget

routes/
├── web.php                               # Chatbot route
└── botman.php                            # BotMan conversation routes
```

### Key Classes

#### PlantChatbotConversation
- Extends `BotMan\BotMan\Messages\Conversations\Conversation`
- Handles conversation flow and user interactions
- Methods:
  - `run()` - Entry point
  - `askForIntent()` - Main menu
  - `recommendPlant()` - Plant recommendation flow
  - `askPlantCare()` - Care guide flow
  - `sharePlantFacts()` - Facts flow
  - `searchPlants()` - Search flow

### User Interface

The chatbot widget includes:
- **Fixed Position Widget** (bottom-right corner)
- **Toggle Button** with plant emoji 🌱
- **Chat Messages** with typing indicators
- **Input Field** for user messages
- **Responsive Design** (works on mobile and desktop)
- **Plant-themed Colors** (green accent colors)

## How It Works

### Conversation Flow

1. **User opens chatbot** → Widget appears with welcome message
2. **User selects option** → Recommendation, Care, Facts, or Search
3. **Based on selection** → Bot asks follow-up questions
4. **Bot provides response** → With relevant information or products
5. **User can continue** → Back to menu or end conversation

### Message Types

- **Text Messages** - Regular conversation text
- **Quick Replies** - Clickable button options
- **Typing Indicators** - Shows bot is thinking
- **Formatted Messages** - Markdown support for bold, italics, etc.

## Configuration

### BotMan Config (`config/botman.php`)

```php
'driver' => 'web',                    // Web driver for web interface
'conversation_cache_time' => 40,      // Cache timeout in minutes
'middleware' => [
    'send_typing_indicator',           // Show typing indicator
],
```

### Routes (`routes/web.php`)

```php
Route::post('/botman/chat', function () {
    $botman = app('botman');
    return $botman->listen();
});
```

## Using the Chatbot

### For Users

1. Click the 🌱 button in bottom-right corner
2. Select an option from the main menu
3. Follow the conversation flow
4. Click buttons or type messages to respond
5. Click "Back to Menu" to return to main options
6. Click "Goodbye" to close the conversation

### For Developers

#### Starting a Conversation

```php
use App\Conversations\PlantChatbotConversation;
use BotMan\BotMan\BotMan;

$botman = app('botman');
$botman->startConversation(new PlantChatbotConversation());
```

#### Adding New Plants to Care Guide

Edit `getCareGuide()` method in `PlantChatbotConversation.php`:

```php
protected function getCareGuide($plant)
{
    $guides = [
        'monstera' => "*🌿 Monstera Care Guide*\n\n...",
        'new_plant' => "*🌿 New Plant Care Guide*\n\n💧 *Watering:* Every X days...",
    ];
    return $guides[$plant] ?? "I don't have detailed care info for that plant yet.";
}
```

#### Customizing Plant Facts

Edit `sharePlantFacts()` method:

```php
public function sharePlantFacts()
{
    $facts = [
        "🌍 Your custom fact here",
        "📚 Another interesting fact",
        // Add more facts
    ];
    // ...
}
```

#### Connecting to Product Database

The chatbot can pull from the `Product` model:

```php
protected function getPlantRecommendation()
{
    return Product::where('is_active', true)
        ->where('category', 'plants')
        ->inRandomOrder()
        ->first();
}
```

## Extending the Chatbot

### Adding New Conversation Flows

1. Create new method in `PlantChatbotConversation`
2. Add to `askForPreference()` switch statement
3. Add button in `askForIntent()` method

### Integrating with E-commerce

The chatbot can:
- Pull real product data from database
- Add items directly to cart
- Show current prices
- Recommend based on product categories

### API Integration

Future enhancements:
- OpenAI integration for natural language understanding
- Machine learning for better recommendations
- Plant identification from images
- Real-time plant availability

## Troubleshooting

### Chatbot Not Appearing

1. Check if widget is included in layout: `@include('components.chatbot.widget')`
2. Clear view cache: `php artisan view:clear`
3. Check browser console for errors

### Routes Not Working

1. Clear route cache: `php artisan route:clear`
2. Verify POST to `/botman/chat` works
3. Check BotMan driver configuration

### Conversation Not Progressing

1. Verify conversation class has `then()` callbacks
2. Check for syntax errors: `php -l app/Conversations/PlantChatbotConversation.php`
3. Review JavaScript console for fetch errors

## Future Features

- 🤖 AI-powered natural language understanding
- 📸 Plant identification via image upload
- 💬 Multi-language support
- 🔔 Plant care reminders
- 📊 User preference tracking
- 🌐 Integration with plant experts
- 🛒 One-click plant purchases
- 📱 WhatsApp/Telegram integration

## Support

For issues or feature requests, contact the development team or file an issue in the project repository.

---

**Last Updated:** May 2026
**Status:** Fully Functional ✅
