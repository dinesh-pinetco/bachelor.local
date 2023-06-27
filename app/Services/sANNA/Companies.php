<?php

namespace App\Services\sANNA;

use App\Models\Company;
use App\Models\CompanyContacts;
use Exception;

class Companies extends ErpService
{
    protected $endpoint = '/platform/firmen';
}
