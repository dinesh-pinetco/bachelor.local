<?php

namespace App\Hubspot;

class Contact extends Base
{
    protected $service;

    public function __construct()
    {
        parent::__construct();

        $this->service = $this->hubSpot->contacts();
    }

    public function find($id)
    {
        return $this->service->getById($id)->getData();
    }

    public function create(array $request)
    {
        return $this->service->create($this->setProperties($request))->getData();
    }

    public function update($id, array $request)
    {
        return $this->service->update($id, $this->setProperties($request))->getData();
    }

    public function updateOrCreate(string $email, array $request)
    {
        return $this->service->createOrUpdate($email, $this->setProperties($request))->getData();
    }

    public function delete($id)
    {
        return $this->service->delete($id)->getData();
    }

    private function setProperties(array $request): array
    {
        $properties = [];
        collect($request)->each(function ($value, $key) use (&$properties) {
            $properties[] = [
                'property' => $key,
                'value' => $value,
            ];
        });

        return $properties;
    }
}
