<?php

namespace App\Implementations;

use App\Interfaces\FinancialFeaturesInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FinancialFeaturesImplementation implements FinancialFeaturesInterface
{
    public function generatePDFReport($ordersData)
    {
        $dompdf = new Dompdf();

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $dompdf->setOptions($options);

        $html = '<html>';
        $html .= '<head><title>Informe Personalizado</title></head>';
        $html .= '<body>';

        foreach ($ordersData as $order) {
            $html .= '<h2>Order ID: '.$order['id'].'</h2>';
            $html .= '<p>Date: '.$order['date'].'</p>';
            $html .= '<p>Total: $'.$order['total'].'</p>';
            $html .= '<ul>';
            foreach ($order['items'] as $item) {
                $html .= '<li>';
                if ($item['type'] === 'product') {
                    $html .= 'Product: '.$item['name'].', Price: $'.$item['price'];
                } elseif ($item['type'] === 'appointment') {
                    $html .= 'Appointment: '.$item['modality'].', Price: $'.$item['price'];
                }
                $html .= ', Quantity: '.$item['quantity'];
                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        $html .= '</body></html>';
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('orders_report.pdf', ['Attachment' => false]);
    }

    public function generateExcelReport($ordersData)
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Order ID');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Total');
        $sheet->setCellValue('D1', 'Item Type');
        $sheet->setCellValue('E1', 'Item Name');
        $sheet->setCellValue('F1', 'Item Price');
        $sheet->setCellValue('G1', 'Quantity');

        $row = 2;
        foreach ($ordersData as $order) {
            foreach ($order['items'] as $item) {
                $sheet->setCellValue('A'.$row, $order['id']);
                $sheet->setCellValue('B'.$row, $order['date']);
                $sheet->setCellValue('C'.$row, $order['total']);

                $sheet->setCellValue('D'.$row, $item['type']);
                if ($item['type'] === 'product') {
                    $sheet->setCellValue('E'.$row, $item['name']);
                    $sheet->setCellValue('F'.$row, $item['price']);
                } elseif ($item['type'] === 'appointment') {
                    $sheet->setCellValue('E'.$row, $item['modality']);
                    $sheet->setCellValue('F'.$row, $item['price']);
                }
                $sheet->setCellValue('G'.$row, $item['quantity']);

                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="orders_report.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
