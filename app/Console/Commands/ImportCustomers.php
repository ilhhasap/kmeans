<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class ImportCustomers extends Command
{
    protected $signature = 'import:customers {file}';
    protected $description = 'Import customers from a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $file = $this->argument('file');

        if (!Storage::exists($file)) {
            $this->error("File not found or not readable.");
            return;
        }

        $header = null;
        $data = array();
        if (($handle = fopen(storage_path('app/' . $file), 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        foreach ($data as $row) {
            Customer::updateOrCreate([
                'id' => $row['id']
            ], [
                'sex' => $row['sex'],
                'marital_status' => $row['marital_status'],
                'age' => $row['age'],
                'education' => $row['education'],
                'income' => $row['income'],
                'occupation' => $row['occupation'],
                'settlement_size' => $row['settlement_size'],
                'cluster' => null
            ]);
        }

        $this->info("Import completed successfully.");
    }
}