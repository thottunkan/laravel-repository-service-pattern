<?php

namespace App\Services;

use App\Repositories\EmiRepositoryInterface;
use DateTime;

class EmiService
{
    protected $emiRepository;

    public function __construct(EmiRepositoryInterface $emiRepository)
    {
        $this->emiRepository = $emiRepository;
    }

    public function createEmiDetailsTable($minDate, $maxDate)
    {
        $start = new DateTime($minDate);
        $end = new DateTime($maxDate);
        $columns = [];

        // Generate the columns for the months between min and max dates
        while ($start <= $end) {
            $columns[] = $start->format('Y_M');
            $start->modify('+1 month');
        }

        $this->emiRepository->createEmiDetailsTable($columns);
    }

    public function processEmiDetails($loans)
    {
        foreach ($loans as $loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);
            $clientEMIs = [];
            $currentDate = new DateTime($loan->first_payment_date);

            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $monthYear = $currentDate->format('Y_M');
                $clientEMIs[$monthYear] = $emiAmount;
                $currentDate->modify('+1 month');
            }

            $this->emiRepository->insertEmiDetails(array_merge(['clientid' => $loan->clientid], $clientEMIs));
        }
    }
}
