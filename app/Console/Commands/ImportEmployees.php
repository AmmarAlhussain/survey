<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Employee;

class ImportEmployees extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:employees {file : Path to the Excel file}';

    /**
     * The console command description.
     */
    protected $description = 'Import employees from all sheets of an Excel file';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file');
        if (! file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }
        $this->info("Loading Excel file: {$filePath}");

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheetNames  = $spreadsheet->getSheetNames();

            $metrics = ['processed' => 0, 'imported' => 0, 'skipped' => 0];

            foreach ($sheetNames as $index => $sheetName) {
                $this->info("Processing sheet: {$sheetName}");
                $rows = $spreadsheet->getSheet($index)->toArray();
                array_shift($rows); // Remove header row

                foreach ($rows as $rowNum => $row) {
                    $metrics['processed']++;

                    // Column mapping
                    $employeeCode = isset($row[0]) ? trim($row[0]) : null;
                    $firstName    = isset($row[1]) ? trim($row[1]) : null;
                    $arabicName   = isset($row[2]) ? trim($row[2]) : null;
                    // Debug blank codes
                    if (empty($employeeCode)) {
                        $this->warn("Row {$rowNum} skipped: missing employee_code");
                        $metrics['skipped']++;
                        continue;
                    }



                    // Skip existing
                    if (Employee::where('employee_code', $employeeCode)->exists()) {
                        $metrics['skipped']++;
                        continue;
                    }

                    // Insert record
                    Employee::create([
                        'employee_code'  => $employeeCode,
                        'first_name'     => $firstName,
                        'arabic_name'    => $arabicName,
                    ]);

                    $metrics['imported']++;
                }

                $this->line("Sheet '{$sheetName}' processed.");
            }

            // Summary
            $this->newLine();
            $this->info('Import completed successfully!');
            $this->table(
                ['Metric', 'Count'],
                [
                    ['Processed', $metrics['processed']],
                    ['Imported',  $metrics['imported']],
                    ['Skipped',   $metrics['skipped']],
                ]
            );

            return 0;
        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }
    }
}
