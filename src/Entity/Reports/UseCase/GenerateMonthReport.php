<?php


namespace App\Entity\Reports\UseCase;

use App\Core\Transaction;
use App\Entity\Reports\ReadModel\ReportsQuery;
use App\Entity\Reports\ReadModel\ReportTask;
use App\Entity\Reports\UseCase\GenerateMonthReport\Command;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Symfony\Component\HttpFoundation\StreamedResponse;


class GenerateMonthReport
{
    private $reportsQuery;
    private $transaction;

    public function __construct(
        ReportsQuery $reportsQuery,
        Transaction $transaction)
    {
        $this->reportsQuery = $reportsQuery;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $tasks = $this->reportsQuery->getTaskDataByUserAndMonth($command->getUser(), $command->getMonth());

        $writer = new Xls($this->generateExcel($command, $tasks));
        $response = new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );

        $filename = 'Report_'.$command->getUser()->getName().'_'.$command->getUser()->getSurname().'_'. date("y_m_d_H-i-s");
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '.xls"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;

    }

    private function generateExcel(Command $command, array $tasks)
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $header = [
            ['key' => 'E1', 'value' => 'Report for '. $command->getUser()->getName().' '.$command->getUser()->getSurname().' and number of month  month: '. $command->getMonth()],
            ['key'=>'A3', 'value'=> 'Description'],
            ['key'=>'B3', 'value'=> 'Project name'],
            ['key'=>'C3', 'value'=> 'Client name'],
            ['key'=>'D3', 'value'=> 'Date start'],
            ['key'=>'E3', 'value'=> 'Date stop'],
            ['key'=>'F3', 'value'=> 'Time'],
        ];

        foreach ($header as $data) {
            $sheet->setCellValue($data['key'],$data['value']);
        }

        $columns = ['A','B','C','D','E','F'];
        foreach ($columns as $column){
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $row = 4;
        /** @var ReportTask $task */
        foreach ($tasks as $task)
        {
            $sheet->setCellValue("A$row", $task->getDescription());
            $sheet->setCellValue("B$row",$task->getProjectName());
            $sheet->setCellValue("C$row",$task->getClientName());
            $sheet->setCellValue("D$row",$task->getDateStart());
            $sheet->setCellValue("E$row",$task->getDateStop());
            $sheet->setCellValue("F$row",$task->getTime());
            $row++;
        }
        return $spreadsheet;
    }




}