<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViaCepTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_viacep_encontra_um_registro()
    {
        $cepValido = '13326120';
        $response = $this->get('/api/search/local/' . $cepValido);

        $response->assertJsonCount(1);
        $response->assertOk();
    }

    public function test_viacep_encontra_mais_registro()
    {
        $cepsValidos = '13326120,01100100,13320000,79806-000';
        $response = $this->get('/api/search/local/' . $cepsValidos);

        $response->assertJsonCount(4);
    }

    public function test_codigo_invalido()
    {
        $cepInvalido = '9999999999';

        $response = $this->get('/api/search/local/' . $cepInvalido);

        $this->assertArrayHasKey('error_code',$response->getOriginalContent()[0]);

    }
}
