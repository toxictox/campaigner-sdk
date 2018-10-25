<?php

namespace Campaigner\Services;

/**
 * @author artur
 */
class BaseService {

    /**
     * @var type string
     */
    protected static $_apiKey;

    public function __construct(string $apiKey = '') {
        self::$_apiKey = $apiKey;
    }

    /**
     * @param string $serviceType
     * @param array $queryParams
     * @param string $endpoint
     * @return type
     * @throws BadRequestException
     * @throws AuthException
     */
    protected function request(string $serviceType, array $queryParams, string $endpoint) {
        $baseUrl = "https://edapi.campaigner.com/v1/{$serviceType}/";


        $requestUrl = (!empty(http_build_query($queryParams))) ? $baseUrl . $endpoint . '?' . http_build_query($queryParams) : $baseUrl . $endpoint;

        $ch = curl_init($requestUrl);

        $headers = [
            'ApiKey:' . self::$_apiKey,
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        $decodedResult = json_decode($result, true);
        if ($result && isset($decodedResult['ErrorCode'])) {
            throw new BadRequestException('Bad Request');
        }
        if (!$result) {
            $message = curl_error($ch);
            curl_close($ch);
            throw new AuthException('Invalid ApiKey provided' . $message);
        }
        curl_close($ch);

        return $result;
    }

}
