<?php
namespace App\Ai\Providers;

use NeuronAI\Providers\OpenAI\OpenAI;

class LMStudio extends OpenAI
{
    protected string $baseUri = 'http://127.0.0.1:1234/v1';
}