<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConnectionDictionary
{
    public static function words(int $length): array
    {
        if(!self::verifyFileDictionary()) return [];

        $words = [];
        foreach(file(storage_path("app/public/dictionary.txt")) as $line){
            if(Str::length(trim($line)) === $length){
                $words[] = trim($line);
            }
        }
        return $words;
    }

    public static function verifyFileDictionary(): bool
    {
        return Storage::disk('public')->exists("dictionary.txt");
    }
}
