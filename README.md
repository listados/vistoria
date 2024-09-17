# Projeto
Projeto de uma vistoria imobiliária da empresa listados
![enter image description here](https://drive.google.com/file/d/12c4rN_iFNQDjPPBSRJqwY7NgmsIPNvl3/view?usp=sharing)

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
