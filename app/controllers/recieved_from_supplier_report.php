<?php

class RecievedFromSupplierReportController
{
    public function handleRequestRecievedSupplier()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['generate_report_recieved_supplier'])) {
                $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

                $report = $this->fetchReportData($startDate, $endDate);


                // $this->renderView($report); 
                // var_dump($report);
            } elseif (isset($_POST['other_action'])) {
                
                $this->handleOtherAction();
            }
        } else {
            
            $this->renderView();
        }
    }


    public function fetchReportData($startDate, $endDate)
    {
        // Your data fetching logic here
        // $dummyData = [];

        // return $dummyData;
    }

    private function renderView($report = [])
    {
        require_once views_path('user-recieved-from-supplier-report/recieved_from_supplier_report');
        require_once views_path('partials/footer');
    }

    private function handleOtherAction()
    {

        // Logic for handling other actions specific to RecieveFromCentralStoreReportController
    }
}

$controller = new RecievedFromSupplierReportController();
$controller->handleRequestRecievedSupplier();


