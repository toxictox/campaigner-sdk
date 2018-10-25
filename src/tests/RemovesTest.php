<?php

namespace Campaigner;

use Campaigner\Services\SubscribersService;
use Campaigner\Exceptions\AuthException;
use Campaigner\Exceptions\BadRequestException;

$subscribersService = new SubscribersService('$2a$10$uWHXSFrAyDExPY8EZw6RYe5QKM7ONXOmt1fMlTrpUsHAApMHIcIdy');

try {

    $contacts = $subscribersService->findBy(
            [
        'Since' => '05/10/2018',
        'PageSize' => 1000,
        'PageNumber' => 1
            ], 'Removes');


    echo 'Page: ' . $contacts->PageNumber . '<br>';
    echo 'Total Pages: ' . $contacts->TotalPages . '<br><br>';
    foreach ($contacts->Items as $contact) {
        echo $contact->EmailAddress . '<br>';
    }
} catch (AuthException $ex) {
    echo $ex->getMessage();
} catch (BadRequestException $ex) {
    echo $ex->getMessage();
}
