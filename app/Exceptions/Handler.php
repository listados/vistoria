<?php

namespace EspindolaAdm\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        

        return parent::render($request, $exception);
    }

    /**
     * Lida com exceções de autenticação em requisições não autenticadas.
     * 
     * Este método é sobrescrito para garantir que requisições que esperam JSON,
     * como chamadas de API, recebam uma resposta adequada (HTTP 401 com JSON),
     * ao invés de serem redirecionadas para uma página de login, o que é o padrão
     * em aplicações web.
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Não autenticado.'], 401);
        }

        return redirect()->guest(route('login'));
    }

}
