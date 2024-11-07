<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Services\LoanService;
use App\Services\EmiService;
use Illuminate\Http\Request; 
use DateTime;

class EmiController extends Controller
{
    protected $loanService;
    protected $emiService;

    public function __construct(LoanService $loanService, EmiService $emiService)
    {
        $this->loanService = $loanService;
        $this->emiService = $emiService;
    }

    public function showProcessPage()
    {
        return view('process');
    }

    public function processData(Request $req)
    {
        // Get all loans
        $loans = $this->loanService->getAllLoans();

        // Get date range for EMI columns
        [$minDate, $maxDate] = $this->loanService->getPaymentDateRange();

        // Create EMI details table with dynamic columns
        $this->emiService->createEmiDetailsTable($minDate, $maxDate);

        // Process and insert EMI details
        $this->emiService->processEmiDetails($loans);

        return redirect('/emidetails');

        
        // $start = new DateTime($minDate);
        // $end = new DateTime($maxDate);
        // $columns = [];

        // // Generate the columns for the months between min and max dates
        // while ($start <= $end) {
        //     $columns[] = $start->format('Y_M');
        //     $start->modify('+1 month');
        // }
    }

    public function showEmiDetails()
    {
        $emiDetails = DB::table('emi_details')->get();
        $emijson=DB::table('emi_details')->get()->toJson();
                // Get date range for EMI columns
        [$minDate, $maxDate] = $this->loanService->getPaymentDateRange();

        $start = new DateTime($minDate);
        $end = new DateTime($maxDate);
        $columns = [];

        // Generate the columns for the months between min and max dates
        while ($start <= $end) {
            $columns[] = $start->format('Y_M');
            $start->modify('+1 month');
        }
      
       return view('emidetails',  compact("emiDetails","columns","emijson"));
    }

    public function showLoanDetails()
    {
        $loans = $this->loanService->getAllLoans();
        // print_r($loans[0]->clientid);
        return view('loandetails', compact('loans'));
    }

}
