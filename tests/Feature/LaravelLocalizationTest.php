<?php

namespace Tests\Feature;

use Tests\TestCase;

class LaravelLocalizationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNoLocaleUrlUsingNoAccept()
    {
        $response = $this->get("/being");
        $response->assertStatus(302);
        $response->assertHeader('Location', 'http://localhost/en/being');
    }

    public function testNoLocaleUrlUsingAccept()
    {
        // can not use laravel test api,  https://github.com/laravel/framework/issues/25601#event-1851094699
//        $response = $this->withHeaders([
//            'Accept-Language' => 'zh',
//            'Accept' => '*/*',
//        ])->get('http://zhenc.test/being');
//        $response->assertStatus(302);
//        $response->assertHeader('Location', 'http://localhost/go');

        // use curl instead
        // curl -s -H 'Accept-Language: zh' -XGET http://zhenc.test/go -v -I

        foreach ([
                     " -H 'Accept-Language: zh' -XGET http://zhenc.test/being -I" => 'HTTP/1.1 200 OK',
                     " -H 'Accept-Language: zh-tw' -XGET http://zhenc.test/being -I" => 'HTTP/1.1 200 OK',

                     " -H 'Accept-Language: fr' -XGET http://zhenc.test/being -I" => 'Location: http://zhenc.test/en/being',


                     " -H 'Accept-Language: zh' -XGET http://zhenc.test -I" => 'HTTP/1.1 200 OK',
                     " -H 'Accept-Language: fr' -XGET http://zhenc.test -I" => 'Location: http://zhenc.test/en',

                 ] as $args => $contains) {
            $this->curlTest($args, $contains);
        }
    }

    function curlTest($args, $contains)
    {
        $cmd = "curl --silent $args";
        exec($cmd, $a, $r);
        if ($r !== 0) {
            echo "\n\n[CMD] error and try agagin: $cmd\n\n";
            system("$cmd -v");
            self::assertTrue(false);
        } else {
            self::assertContains($contains, $a, "[please try] $cmd -v");
        }

    }
}
