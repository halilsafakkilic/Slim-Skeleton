<?php

namespace App\Domain\User\Exception;

use App\Domain\Exception\DomainRecordNotFoundException;

class UserNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}