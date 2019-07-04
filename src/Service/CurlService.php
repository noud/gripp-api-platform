<?php

namespace App\Service;

class CurlService
{
    const urlBase = 'http://gripp.localhost';
    
    public function execute(string $uri, string $jwt): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::urlBase.$uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $output = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ('' !== $error) {
            $output = [$error];
        }
        $output = (array) json_decode($output);
        
        return $output;
    }
}
