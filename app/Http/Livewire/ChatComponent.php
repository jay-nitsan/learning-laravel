<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\ChatGPTService;

class ChatComponent extends Component
{
    public $messages = [];
    public $input = '';

    protected $chatGPTService;

    public function mount(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function sendMessage()
    {
        if (empty($this->input)) return;

        $this->messages[] = ['user' => 'You', 'text' => $this->input];

        $response = $this->chatGPTService->generateResponse($this->input);

        $this->messages[] = ['user' => 'ChatGPT', 'text' => $response];

        $this->input = '';
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
