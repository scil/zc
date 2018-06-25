<?php

namespace App\Services;


class Http2Push
{
    const COOKIE_NAME = 'tagpush';
    /**
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

    public function registerGulpFiles()
    {
        foreach ($this->getGulpRevTokerns() as $tag => $info) {
            $this->queueTag($tag, $info['token'],
                "/rev/all-{$info['token']}.{$info['ext']}",
                static::getTypeByExtension($info['ext']));
        }
    }

    /**
     * use 'base.blade.php.product' produced by gulp
     */
    public function getGulpRevTokerns()
    {
        $content = @file_get_contents(resource_path('views/layouts/base.blade.php.product'));
        if (preg_match('#\<link href="/rev/all-(\w+)\.css"#', $content, $matches)) {
            $t['css'] = ['token' => $matches[1], 'ext' => 'css'];
        }
        if (preg_match('#\<script src="/rev/all-(\w+)\.js"#', $content, $matches)) {
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
            if ($links) {
                foreach ($this->tagged as $tag => $info) {
                    $cookies[$tag] = $info['token'];
                }
            }
        }

        return [
            $links,
            cookie(static::COOKIE_NAME, $cookies ? json_encode($cookies) : '',99999)
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