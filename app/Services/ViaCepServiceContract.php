<?php

namespace App\Services;

interface ViaCepServiceContract
{
    public function get(string $postalCode);

}
