<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmiRepository implements EmiRepositoryInterface
{
    public function createEmiDetailsTable($columns)
    {
        // Drop the table if it exists
        Schema::dropIfExists('emi_details');

        // Create EMI details table dynamically
        DB::statement('CREATE TABLE emi_details (clientid INT)');
        foreach ($columns as $column) {
            DB::statement("ALTER TABLE emi_details ADD {$column} DECIMAL(10, 2) DEFAULT 0");
        }
    }

    public function insertEmiDetails($data)
    {
        DB::table('emi_details')->insert($data);
    }
}
