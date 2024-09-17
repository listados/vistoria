# Projeto
Projeto de uma vistoria imobiliária da empresa listados
![Captura de tela de 2024-09-16 21-29-21](https://github.com/user-attachments/assets/190d26f3-affe-4481-9bdd-86176e0b6ab4)


### Instalação do npm

 - git clone
 - git fetch --all
 - git switch develop
 - docker compose up -d
 - rm -rf node_modules
 - rm package-lock.json yarn.lock
 - npm cache clear --force
 - npm install cross-env
 - npm instal
 - docker exec phpvistoria-vue composer update
 - chgrp -R www-data storage bootstrap/cache
 - chmod -R ug+rwx storage bootstrap/cache
 - docker exec phpvistoria-vue php artisan migrate

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
