<?php

namespace App\Interfaces;

interface FinancialFeaturesInterface
{
    public function generatePDFReport($ordersData);

    public function generateExcelReport($ordersData);
}
