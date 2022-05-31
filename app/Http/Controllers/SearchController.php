<?php

namespace App\Http\Controllers;

use App\Services\ViaCepServiceContract;

class SearchController extends Controller
{
    private $viaCepService;

    public function __construct(ViaCepServiceContract $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    public function local(string $postalCodeList)
    {
        $arrPostalCodes = explode(',', $postalCodeList);

        return $this->formatResult($arrPostalCodes);
    }

    private function formatResult(array $arrPostalCodes): array
    {
        $result = [];

        foreach ($arrPostalCodes as $item) {
            $postalCodeResponse = $this->viaCepService->get($item);

            if (isset($postalCodeResponse->error_code)) {
                $result[] = [
                    "cep" => $item,
                    "message" => $postalCodeResponse->message
                ];

                continue;
            }

            $arrKeyValue = [];
            foreach ($postalCodeResponse as $key => $value) {
                $arrKeyValue[$key] = $value;
            }

            $result[] = $arrKeyValue;
        }

        return $result;
    }
}
