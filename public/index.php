De retour dans quelques minutes...

<?php

    require __DIR__ . '/../vendor/autoload.php';

    use tightenco\collect;
    use larapack\dd;

    $oldURIs = collect([
        'reseau-www' => 'https://www.zoneski.com/reseau/',
        'reseau' => 'https://zoneski.com/reseau/',
        'ecole-www' => 'https://www.zoneski.com/ecole/',
        'ecole' => 'https://zoneski.com/ecole/',
        'forum' => 'https://zoneski.com/forum/',
        'forum-www' => 'https://www.zoneski.com/forum/',
    ]);

    $newURIs = collect([
        'reseau-www' => 'https://zone.ski/',
        'reseau' => 'https://zone.ski/',
        'ecole' => 'https://boutiqu.zone.ski/',
        'ecole-www' => 'https://boutiqu.zone.ski/',
        'forum' => 'https://forum.zone.ski/',
        'forum-www' => 'https://forum.zone.ski/',
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
