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

# 3. Executa composer install IGNORANDO erro inicial
echo "🎼 Primeira tentativa de composer (pode falhar)..."
composer install || true

# 4. Corrige bug no PackageManifest (se existir)
MANIFEST_FILE="vendor/laravel/framework/src/Illuminate/Foundation/PackageManifest.php"
if [ -f "$MANIFEST_FILE" ] && grep -q '$packages = json_decode' "$MANIFEST_FILE"; then
  echo "⚙️ Corrigindo PackageManifest.php..."
  sed -i '116s/.*/    $installed = json_decode($this->files->get($path), true);\n    $packages = $installed["packages"] ?? $installed;/' "$MANIFEST_FILE"
fi

# 5. Composer novamente (agora deve funcionar)
echo "🎼 Segunda tentativa de composer (após fix)..."
composer install

# 6. Ajusta permissões
echo "🔐 Ajustando permissões..."
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# 7. Gera APP_KEY se necessário
if ! grep -q '^APP_KEY=base64:' .env; then
  echo "🔑 Gerando chave da aplicação..."
  php artisan key:generate
fi

echo "✅ Ambiente Laravel pronto."
exec "$@"
