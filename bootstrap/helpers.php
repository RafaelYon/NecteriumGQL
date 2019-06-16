<?php

/**
 * "Die and print"
 * 
 * Exibe o valor de $data formatado e encerra a execução
 * 
 * @param $data
 */
function dp ($data)
{
    echo '<pre>';
    var_dump($data);
    die();
}

/**
 * Obtém um dado específicado dos arquivos de configuração configuração
 */
function config(string $section)
{    
    $firstDotPos = strpos($section, '.');

    $file = substr($section, 0, $firstDotPos);
    $keys = substr($section, $firstDotPos + 1);

    $data = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'config' . DIRECTORY_SEPARATOR . $file . '.php';

    return App\Support\ArrayHelper::dotNestedAccess($keys, $data);
}

/**
 * Obtém um grupo de rotas a disponívels
 * 
 * @param string $type Valores possíveis: 'web' || 'api'
 * @param string $method Valores possíveis: 'GET' || 'POST'
 */
function routes(string $type, string $method)
{
    return config(implode('.', ['routes', $type, $method]));
}

/**
 * Retorna uma nova instance de Response
 * 
 * @param string $content O conteúdo da respota
 * @param int $code O código HTTP da resposta
 */
function response($content, int $code = 200) : App\Http\Response
{
    return new App\Http\Response($content, $code);
}

/**
 * Cria uma respota usando uma view
 * 
 * @param string $keyView A chave para encontrar a view
 * @param array $vars As variaveis que serão utilizadas pela view
 * @param int $code O código HTTP da respota
 */
function view(string $keyView, array $vars = null, int $code = 200) : App\Http\Response
{
    $view = App\Builder\Views\View::make($keyView, $vars);

    return response($view, $code);
}

function redirect(string $url, bool $permanent = false, bool $found = true)
{
    App\Http\Response::redirect($url, $permanent, $found);
}

/**
 * Obtém o caminho para um arquivo publico.
 */
function publicPath(string $file = '') : string
{
    return config('app.public_path') . $file;
}

/**
 * Obtém o caminho para um arquivo resource
 */
function resourcePath(string $resourceKey)
{
    $pathParts = explode('.', $resourceKey);

    return config('app.resources.folder')
            . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';
}

function resourceFile(string $relativePath)
{
    return ROOT_FOLDER . 'resources/' . $relativePath;
}

/**
 * Gera um token csrf
 */
function csrf()
{
    return App\Security\Csrf::create();
}

function inputCsrf()
{
    return '<input type="hidden" name="csrf" value="' . csrf() . '">';
}

function session()
{
    return App\Security\Session::class;
}

function auth()
{
    return App\Security\Auth\Auth::class;
}