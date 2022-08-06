<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Builders\GenerateWords as GenerateAllWords;
use Livewire\Component;

class GenerateWords extends Component
{
    public string $letters = '';
    public int|string|null $number = null;
    public string $words = '';

    protected $rules = [
        'letters' => 'required|min:12|max:12|alpha',
        'number' => 'required|min:2|max:12|numeric|int',
    ];

    public function render(): Factory|View|Application
    {
        return view('livewire.generate-words');
    }

    public function generate()
    {
        $this->words = '';
        $data = $this->validate();

        $words = GenerateAllWords::searchWordsLength($data['number']);
        $result = GenerateAllWords::buildWords($words, $data['letters']);

        $this->words = !!count($result)
            ? collect($result)->implode(', ') . '.'
            : "No se encontraron palabras de {$data['number']} caracteres al combinar las letras {$data['letters']}";
    }
}
