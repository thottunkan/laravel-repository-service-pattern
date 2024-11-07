<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class LoanRepository implements LoanRepositoryInterface
{
    public function getAllLoans()
    {
        return DB::table('loan_details')->get();
    }

    public function getMinFirstPaymentDate()
    {
        return DB::table('loan_details')->min('first_payment_date');
    }

    public function getMaxLastPaymentDate()
    {
        return DB::table('loan_details')->max('last_payment_date');
    }

    public function insertLoanDetails($data)
    {
        DB::table('loan_details')->insert($data);
    }
}
