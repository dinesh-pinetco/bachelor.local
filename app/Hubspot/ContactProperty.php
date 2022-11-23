<?php

namespace App\Hubspot;

class ContactProperty extends Base
{
    protected $service;

    public function __construct()
    {
        parent::__construct();

        $this->service = $this->hubSpot->contactProperties();
    }

    public function get()
    {
        return $this->service->all()->getData();
    }

    public function findByName($name)
    {
        return $this->service->get($name)->getData();
    }

    public function create(array $request)
    {
        return $this->service->create($request)->getData();
    }

    public function exists($name)
    {
        try {
            return (bool) ($this->service->get($name)->getStatusCode());
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($name)
    {
        return $this->service->delete($name)->getData();
    }

    public function update($name, array $request)
    {
        return $this->service->update($name, $request)->getData();
    }
}
