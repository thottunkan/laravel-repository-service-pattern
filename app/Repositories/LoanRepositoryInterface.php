<?php

namespace App\Repositories;

interface LoanRepositoryInterface
{
    public function getAllLoans();
    public function getMinFirstPaymentDate();
    public function getMaxLastPaymentDate();
    public function insertLoanDetails($data);
}
