<?php

require 'vendor/autoload.php';

$a = new \App\ArticleAggregator();

/**
 * Récupère les articles de la base de données, avec leur source.
 * host, username, password, database name
 */
/**
 * Ajout du name pour spécifier le connecteur
 */
$a->appendDatabase('database', 'alltricks', 'alltricks', 'alltricks');

/**
 * Récupère les articles d'un flux rss donné
 * source name, feed url
 */
$a->appendRss('Le Monde', 'http://www.lemonde.fr/rss/une.xml');

foreach ($a as $article) {
    echo sprintf('<h2>%s</h2><em>%s</em><p>%s</p>',
        $article->getName(),
        $article->getSourceName(),
        $article->getContent()
    );
}
