<?php

namespace Campaigner\Services;

/**
 * @author artur
 */
class SubscribersService extends BaseService {

    public function __construct(string $apiKey) {
        parent::__construct($apiKey);
    }

    /**
     * @param array $condition
     * @param string $withStatus
     * @return type array
     */
    public function findBy(array $condition, string $withStatus) {
        return json_decode($this->request('Subscribers', $condition, $withStatus));
    }

}
