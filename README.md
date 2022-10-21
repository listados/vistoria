# README #

This README would normally document whatever steps are necessary to get your application up and running.

### Insalação ###
* docker-compose exec php-fpm composer install

* Quick summary
* Version
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### How do I get set up? ###

* Summary of set up
* Configuration
* Dependencies
* Database configuration
* How to run tests
* Deployment instructions

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Erro index: name PackageManifest.php  ###

``` vendor/laravel/framework/src/Illuminate/Foundation/PackageManifest.php ```
Comentar a linha 116
``` $packages = json_decode($this->files->get($path), true); ```
Add o trecho de codigo
``` 
    $installed = json_decode($this->files->get($path), true);
    $packages = $installed['packages'] ?? $installed;
```
* Repo owner or admin
* Other community or team contact

### Stack ###
Node: 12
Npm: 6 ou 8
