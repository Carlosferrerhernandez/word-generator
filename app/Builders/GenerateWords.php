<?php

namespace App\Builders;

use App\Classes\ConnectionDictionary;
use Illuminate\Support\Str;

class GenerateWords
{

    public static function searchWordsLength(int $length): array
    {
        return ConnectionDictionary::words($length);
    }

    public static function buildWords(Array $words, String $string): array
    {
        $resul = [];
        foreach ($words as $word){
            $letters = str_split(Str::lower($string));
            $newWord = str_split(self::removeSpecialCharacters($word));
            $valid = true;
            foreach ($newWord as $char){
                if(in_array($char, $letters)){
                    if (($key = array_search($char, $letters)) !== false) {
                        unset($letters[$key]);
                    }
                }else{
                    $valid = false;
                    break;
                }
            }
            if($valid){
                $resul[] = $word;
            }
        }

        return $resul;
    }

    public static function removeSpecialCharacters(String $word): string
    {
        $originals = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ';
        $replaces = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
        $word = utf8_decode($word);
        $word = strtr($word, utf8_decode($originals), $replaces);
        $word = strtolower($word);
        return utf8_encode($word);
    }
}
