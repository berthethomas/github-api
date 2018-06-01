github-api
==========
Projet développé en Symfony (v3.4). Projet mettant en place GraphQL de plusieurs manières : 
- Mise en place d'une API REST (Simple *create* en base)
- Exploiter une API GraphQL depuis le coté serveur (API Github ==> https://api.github.com/graphql)
- Mettre en place une API GraphQL (Bundle Youshido/GraphQLBundle ==> https://github.com/youshido/graphqlbundle)
- Exploiter une API GraphQL depuis le coté client (Ajax Request)

## Installation
- Cloner le projet GIT
- Importer la base de données sur un serveur type MySQL
```
/github-api.sql
```
- Renommer le fichier parameters.yml.dist par parameters.yml tout en insérant votre configuration
```
cp app/config/parameters.yml.dist app/config.parameters.yml
```
- Mettre à jour les dépendances
```
composer install
```
- Lancer le serveur
```
php bin/console server:run
```
L'outil est maintenant accessible depuis http://localhost:8000

## Liste des fonctionnalités disponibles
### Github Finder
*Permet d'acceder à l'API github et récupère la liste des projets disponibles en fonction du nom d'utilisateur Github saisie*
```
http://localhost:8000/github
```
### API REST
*Permet d'implémenter les données pour les livres et les auteurs uniquement via des requêtes POST*

#### Ajouter un auteur
```
http://localhost:8000/rest/auteur/add
```
##### Paramètres attendus : 
- nom (String)
- prenom (String)
- date_naissance (String format yyyy-mm-dd)

#### Ajouter un livre
```
http://localhost:8000/rest/livre/add
```
##### Paramètres attendus : 
- titre (String)
- genre (String)
- date_parution (String format yyyy-mm-dd)
- prix (Float)
- auteur_id (Integer existant en base de données)

### API GraphQL
*Permet de consulter les données liés aux différentes données de l'application.*
##### Documentation disponible dans le répo ici (documentation générée par graphdoc) : 
```
/app/Resources/views/doc/schema/index.html
```
GraphiQL est également disponible via ce lien (interface web permettant de tester vos différentes requêtes vers l'API GraphQL):
```
http://localhost:8000/graphql/explorer
```

### Application Web
*Implémentation de l'API GraphQL de l'application via des requêtes Ajax*
```
http://localhost:8000/graphql
```
