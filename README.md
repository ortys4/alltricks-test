Bonjour,

Voici mon implémentation du test technique **AllTricks**

## Pour demarrer le projet

La configuration docker-compose est en partie récupérer depuis d'autres projets.
Pour l'adapter à votre environnement, copier `docker-compose.override.yml.dist` vers `docker-compose.override.yml`
Notre surcharge permet de fonctionner sur notre environnement de dev avec Traefik

Puis

```sh
    make start && make run
```


## Mes choix

J'ai codé en PHP 7.4 pour tester le comportement des variables typées.
J'ai utilisé l'autoloader de composer pour me simplifier la tache

## Et si j'avais eu symfony

J'aurais utilisé l'autowiring pour instancier les objets `DatabaseConnector` et `RssFeedConnector`
Grace à l'interface `ConnectorInterface` j'aurai alimenté la collection de connector `ArticleAggregator`

```yaml
#services.yaml

services:
    _defaults:
        ...
        bind:
            $connectorList: !tagged alltricks.connector
    _instanceof:
        App\ConnectorInterface:
            tags: ['alltricks.connector']
```
