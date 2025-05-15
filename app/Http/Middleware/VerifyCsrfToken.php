<?php

namespace EspindolaAdm\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // Desativa a verificação CSRF para todas as rotas que começam com 'api/'
        // Isso é comum em APIs, já que normalmente elas usam tokens (como JWT ou session cookie) em vez de CSRF tokens.
        'api/*',
    ];
}
