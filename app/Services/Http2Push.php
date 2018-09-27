<?php

namespace App\Services;


/**
 * Class Http2Push
 * Get resources and their tokens and save into $tagged,
 * then , in each request,
 * produce links and update cookies according $tagged and client cookies if some resouces have not pushed
 *
 * @package App\Services
 */
class Http2Push
{
    const COOKIE_NAME = 'tagpush';

    const URL_PREFIX = '/rev/all-';

    const TOKEN_FROM = 'views/layouts/base.blade.php.product';
    /**
     * resource's push text and token
     *
     * @var array
     *
     * [
     *  'tageName'=>['text'=>'', 'token'=>'',],
     * ]
     */
    protected $tagged = [];

    /**
     * @var array
     */
    protected $untagged = [];


    /**
     * @param $tag
     * @param $token
     * @param $path string|array
     * @param null $type
     */
    public function queueTag($tag, $token, $path, $type = null)
    {
        $this->tagged[$tag] = [
            'token' => $token,
            'text' => is_string($path) ? static::formatSinglePath($path, $type) : static::formatPaths($path, $type),
        ];
    }

    public function registerGulpProducedFilesWithToken()
    {
        foreach ($this->getGulpRevTokerns() as $tag => $info) {
            $this->queueTag($tag, $info['token'],
                static::URL_PREFIX . "{$info['token']}.{$info['ext']}",
                static::getTypeByExtension($info['ext']));
        }
    }

    /**
     * get token by using 'base.blade.php.product' produced by gulp
     *
     * @return array
     * [
     *  'css'=> ['token'=>'...', 'ext'=>'css'],
     *  'js'=> ['token'=>'...', 'ext'=>'js'],
     * ]
     */
    protected function getGulpRevTokerns()
    {
        $content = @file_get_contents(resource_path(static::TOKEN_FROM));
        if (preg_match('#\<link href="'.static::URL_PREFIX.'(\w+)\.css"#', $content, $matches)) {
            $t['css'] = ['token' => $matches[1], 'ext' => 'css'];
        }
        if (preg_match('#\<script src="'.static::URL_PREFIX.'(\w+)\.js"#', $content, $matches)) {
            $t['js'] = ['token' => $matches[1], 'ext' => 'js'];
        }
        return $t;
    }

    public function hasLinks(): bool
    {
        return $this->tagged || $this->untagged;
    }

    public function generateLinksCookies()
    {
        $links = [];
        $cookies = [];

        if ($this->tagged) {
            $clients = \Cookie::get(static::COOKIE_NAME);
            $clients = $clients ? json_decode($clients) : null;
            foreach ($this->tagged as $tag => $info) {
                if ($clients && isset($clients->tag) && $clients->tag === $info['token']) {
                    continue;
                }
                $links[] = $info['text'];
            }
            if ($links || !$clients) {
                foreach ($this->tagged as $tag => $info) {
                    $cookies[$tag] = $info['token'];
                }
            }
        }

        return [
            $links,
            $cookies ? cookie(static::COOKIE_NAME, json_encode($cookies), 99999) : null
        ];
    }

    /**
     * @param string $resourcePath
     *
     * @return string
     *
     * from: https://github.com/tomschlick/laravel-http2-server-push/blob/master/src/HttpPush.php
     */
    public static function getTypeByExtension(string $resourcePath): string
    {
        $parts = explode('.', $resourcePath);
        $extension = end($parts);
        switch ($extension) {
            case 'css':
                return 'style';
            case 'js':
                return 'script';
            case 'ttf':
                return 'font';
            case 'otf':
                return 'font';
            case 'woff':
                return 'font';
            case 'woff2':
                return 'font';
            default:
                return 'image';
        }
    }

    static public function formatSinglePath($path, $type = null): string
    {
        return '<' . $path . '>; rel=preload; as=' .
            ($type ?: static::getTypeByExtension($path));
    }

    /**
     * @param $paths
     *  [ path1, path2=>type, ... ]
     * @return string
     */
    static public function formatPaths($paths, $globalType = null): string
    {
        foreach ($paths as $path => $type) {
            if (is_int($path)) {
                $path = $type;
                $type = $globalType;
            }
            $texts[] = static::formatSinglePath($path, $type);
        }
        return implode(',', $texts);

    }
}