<?php

    require __DIR__ . '/../vendor/autoload.php';

    use tightenco\collect;
    use larapack\dd;

    $oldURIs = collect([
        'root-www' => 'https://www.zoneski.com',
        'root' => 'https://zoneski.com',
        'reseau-www' => 'https://www.zoneski.com/reseau',
        'reseau' => 'https://zoneski.com/reseau',
        'ecole-www' => 'https://www.zoneski.com/ecole',
        'ecole' => 'https://zoneski.com/ecole',
        'forum' => 'https://zoneski.com/forum',
        'forum-www' => 'https://www.zoneski.com/forum',
    ]);

    $newURIs = collect([
        'root-www' => 'https://zone.ski',
        'root' => 'https://zone.ski',
        'reseau-www' => 'https://zone.ski',
        'reseau' => 'https://zone.ski',
        'ecole' => 'https://boutique.zone.ski',
        'ecole-www' => 'https://boutique.zone.ski',
        'forum' => 'https://forum.zone.ski',
        'forum-www' => 'https://forum.zone.ski',
    ]);

    $currentURI = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    echo "Si vous appercevez cette page et n'êtes pas redirigés dans les prochaines 5 secondes, il y a une erreur. Veuillez contacter l'administrateur (jp@atomescroch.us) et mentionner l'adresse suivante: {$currentURI}";

    $oldURIs->each(function ($uri, $key) use ($currentURI, $newURIs) {
        
        $found = strpos($currentURI, $uri);
        // echo $currentURI;
        // echo "<br>";
        // echo $uri;
        // echo "<br>";
        // echo $found;
        // echo "<br>";
        // echo "---";
        // echo "<br>";
        
        if ($found !== false) {
            $redirectTo = str_replace($uri, $newURIs[$key], $currentURI);

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: {$redirectTo}");
        }
    });
