<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Repositories\IntegrationRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IntegrationRequest;
use App\Http\Requests\IntegrationUpdateRequest;

class IntegrationController extends Controller
{
    protected $integrationRepository;

    public function __construct(IntegrationRepository $integrationRepository)
    {
        $this->integrationRepository = $integrationRepository;
    }

    public function store(IntegrationRequest $request)
    {
        $integration = $this->integrationRepository->create($request->all());
        return response()->json($integration, 201);
    }

    public function update(IntegrationUpdateRequest $request, $id)
    {
        $integration = $this->integrationRepository->update($id, $request->all());
        return response()->json($integration, 200);
    }

    public function destroy($id)
    {
        $this->integrationRepository->delete($id);
        return response()->json(['message' => 'Integration deleted successfully'], 204);
    }
}
