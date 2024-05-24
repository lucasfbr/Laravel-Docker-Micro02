<?php

namespace App\Services;

use App\Services\Traits\ConsumerExternalService;

class CompanyService  
{
    use ConsumerExternalService;

    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('services.micro_01.token');
        $this->url   = config('services.micro_01.url'); 
            
    }

    public function getCompany(string $company)
    {
        return $this->request('get', "/companies/$company");
    }
}  