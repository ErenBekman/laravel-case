<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Repositories\IntegrationRepository;

class ManageIntegration extends Command
{
    protected $signature = 'integration:manage {action} {--id=} {--marketplace=} {--username=} {--password=}';
    protected $description = 'Manage integrations';
    protected $integrationRepository;

    public function __construct(IntegrationRepository $integrationRepository)
    {
        parent::__construct();
        $this->integrationRepository = $integrationRepository;
    }

    public function handle()
    {
        $action = $this->argument('action');
        $id = $this->option('id');
        $data = [
            'marketplace' => $this->option('marketplace'),
            'username' => $this->option('username'),
            'password' => $this->option('password')
        ]; 

        switch ($action) {
            case 'create':
                $this->integrationRepository->create($data);
                $this->info('Integration added successfully.');
                break;

            case 'update':
                $this->integrationRepository->update($id, $data);
                $this->info('Integration updated successfully.');
                break;

            case 'delete':
                $this->integrationRepository->delete($id);
                $this->info('Integration deleted successfully.');
                break;

            default:
                $this->error('Invalid action. Use add, update, or delete.');
                break;
        }
    }
}
