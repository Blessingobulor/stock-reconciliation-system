<?php

class BranchSalesReportController
{
    public function handleRequestBranch()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['generate_report_branch'])) {
                $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

                $reports = $this->fetchReportData($startDate, $endDate);

                // $this->renderView($report);
                

            } elseif (isset($_POST['other_action'])) {
                
                $this->handleOtherAction();
            }

        } else {
            
            $this->renderView();
        }
    }

    public function fetchReportData($startDate, $endDate)
    {
       
        // $dummyData = [];

        // return $dummyData;
    }

    public function renderView($report = [])
    {
        require_once views_path('user-branch-sales-invoice-report/branch_sales_invoice_report');
        require_once views_path('partials/footer');
    }

    public function handleOtherAction()
    {

        
    }
}

$controller = new BranchSalesReportController();
$controller->handleRequestBranch();


