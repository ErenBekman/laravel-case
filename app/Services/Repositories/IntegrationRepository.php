<?php

namespace App\Services\Repositories;
use App\Models\Integration;
use App\IntegrationRepositoryInterface;

class IntegrationRepository implements IntegrationRepositoryInterface
{
    public function create(array $data)
    {
        return Integration::create($data);
    }

    public function update($id, array $data)
    {
        $integration = Integration::findOrFail($id);
        $integration->update($data);
        return $integration;
    }

    public function delete($id)
    {
        $integration = Integration::findOrFail($id);
        $integration->delete();
        return $integration;
    }
}
