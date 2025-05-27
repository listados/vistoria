#!/bin/bash
set -e

echo "📦 Iniciando setup do ambiente Laravel..."

# 0. Garante que .env existe
if [ ! -f .env ]; then
  echo "📄 Arquivo .env não encontrado, copiando de .env.example..."
  cp .env.example .env
fi

# 1. Limpa dependências Node anteriores
echo "🧹 Limpando node_modules e caches..."
rm -rf node_modules package-lock.json yarn.lock
npm cache clear --force

# 2. Instala dependências do frontend
echo "📥 Instalando dependências Node..."
npm install
npm install cross-env

# 3. Composer
echo "🎼 Executando composer..."
composer install || composer update

# 4. Corrige permissões para o Laravel
echo "🔐 Ajustando permissões..."
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# 5. Corrige bug no PackageManifest
MANIFEST_FILE="vendor/laravel/framework/src/Illuminate/Foundation/PackageManifest.php"
if grep -q '$packages = json_decode' "$MANIFEST_FILE"; then
  echo "⚙️ Corrigindo PackageManifest.php..."
  sed -i '116s/.*/    $installed = json_decode($this->files->get($path), true);\n    $packages = $installed["packages"] ?? $installed;/' "$MANIFEST_FILE"
fi

echo "✅ Ambiente Laravel pronto. Iniciando php-fpm..."
exec php-fpm
