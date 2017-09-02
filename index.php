<?php

    require __DIR__ . '/vendor/autoload.php';

    use tightenco\collect;
    use larapack\dd;

    $oldURIs = collect([
        'reseau' => 'https://www.zoneski.com/reseau/',
        'ecole' => 'https://www.zoneski.com/ecole/',
        'forum' => 'https://www.zoneski.com/forum/',
        'test' => 'http://zoneski-redirector.dev/',
    ]);

    $newURIs = collect([
        'reseau' => 'https://zone.ski/',
        'ecole' => 'https://boutiqu.zone.ski/',
        'forum' => 'https://forum.zone.ski/',
        'test' => 'https://zone.ski/',
    ]);

    $currentURI = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



    $oldURIs->each(function ($uri, $key) use ($currentURI, $newURIs) {
        
        $found = strpos($currentURI, $uri);
        
        if ($found !== false) {
            $redirectTo = str_replace($uri, $newURIs[$key], $currentURI);

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: {$redirectTo}");
        }
    });
