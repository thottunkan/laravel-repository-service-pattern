<?php

namespace App\Services;

use App\Repositories\LoanRepositoryInterface;

class LoanService
{
    protected $loanRepository;

    public function __construct(LoanRepositoryInterface $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    public function getAllLoans()
    {
        return $this->loanRepository->getAllLoans();
    }

    public function getPaymentDateRange()
    {
        $minDate = $this->loanRepository->getMinFirstPaymentDate();
        $maxDate = $this->loanRepository->getMaxLastPaymentDate();
        return [$minDate, $maxDate];
    }
}
