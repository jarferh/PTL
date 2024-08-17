<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectName = $_POST['projectName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $framework = $_POST['framework'];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the title and project information
    $sheet->setCellValue('A1', 'Project Timeline');
    $sheet->setCellValue('A3', 'Project Name');
    $sheet->setCellValue('B3', $projectName);
    $sheet->setCellValue('A4', 'Start Date');
    $sheet->setCellValue('B4', $startDate);
    $sheet->setCellValue('A5', 'End Date');
    $sheet->setCellValue('B5', $endDate);
    $sheet->setCellValue('A6', 'Framework');
    $sheet->setCellValue('B6', ucfirst($framework));

    // Style the title
    $header = 'A1:E1';
    $sheet->getStyle($header)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9E1F2'); // Light blue color
    $sheet->getStyle($header)->getFont()->setBold(true)->setColor(new Color('FF333333'));
    $sheet->getStyle($header)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($header)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    // $sheet->getStyle('A1')->getFont()->setSize(16)->setColor(new Color('FF333333'));
    // $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A1:E1');

    // Style project information
    $sheet->getStyle('A3:B6')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('A3:A6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF2F2F2');

    // Style header cells
    $sheet->setCellValue('A8', 'Phase');
    $sheet->setCellValue('B8', 'Start Date');
    $sheet->setCellValue('C8', 'End Date');
    $sheet->setCellValue('D8', 'Details');
    $sheet->setCellValue('E8', 'Completed');
    $headerRange = 'A8:E8';
    $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9E1F2');
    $sheet->getStyle($headerRange)->getFont()->setBold(true)->setColor(new Color('FF333333'));
    $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // Define simplified phases and tasks
    $phases = [
        'Planning and Requirements Gathering' => [
            'startDate' => $startDate,
            'endDate' => date('Y-m-d', strtotime("$startDate + 1 week")),
            'details' => [
                'Market Research: Identify audience and competitors.',
                'Feature Prioritization: List core features and create backlog.',
                'Scope Definition: Outline project goals and boundaries.',
                'Team Formation: Assemble required team members.'
            ]
        ],
        'Design and Prototyping' => [
            'startDate' => date('Y-m-d', strtotime("$startDate + 1 week")),
            'endDate' => date('Y-m-d', strtotime("$startDate + 2 weeks")),
            'details' => [
                'Information Architecture: Plan content and navigation.',
                'Wireframing: Create screen layouts.',
                'UI/UX Design: Develop design and user experience.',
                'Prototyping: Build interactive models for feedback.'
            ]
        ],
        'Development' => [
            'startDate' => date('Y-m-d', strtotime("$startDate + 2 weeks")),
            'endDate' => date('Y-m-d', strtotime("$startDate + 4 weeks")),
            'details' => [
                'Sprint Planning: Break project into sprints.',
                'Development: Write code for features.',
                'Continuous Integration: Regularly integrate code.',
                'Testing: Conduct unit and integration testing.'
            ]
        ],
        'Testing and Quality Assurance' => [
            'startDate' => date('Y-m-d', strtotime("$startDate + 4 weeks")),
            'endDate' => date('Y-m-d', strtotime("$startDate + 5 weeks")),
            'details' => [
                'Functional Testing: Ensure features work.',
                'Performance Testing: Test speed and stability.',
                'Security Testing: Check for vulnerabilities.',
                'Usability Testing: Collect user feedback.'
            ]
        ],
        'Deployment and Release' => [
            'startDate' => date('Y-m-d', strtotime("$startDate + 5 weeks")),
            'endDate' => $endDate,
            'details' => [
                'App Store Submission: Submit to the app store.',
                'Launch Marketing: Promote the app.',
                'Post-Launch Support: Provide support and fix issues.'
            ]
        ],
        'Maintenance and Updates' => [
            'startDate' => date('Y-m-d', strtotime("$endDate")),
            'endDate' => date('Y-m-d', strtotime("$endDate + 1 month")),
            'details' => [
                'Bug Fixing: Address reported issues.',
                'Feature Updates: Add new features.',
                'Performance Optimization: Improve app performance.',
                'Security Patches: Fix security issues.'
            ]
        ]
    ];

    // Populate the Excel sheet with phases and tasks
    $row = 9;
    foreach ($phases as $phase => $data) {
        $sheet->setCellValue('A' . $row, $phase);
        $sheet->setCellValue('B' . $row, $data['startDate']);
        $sheet->setCellValue('C' . $row, $data['endDate']);
        $details = implode("\n", $data['details']);
        $sheet->setCellValue('D' . $row, $details);

        // Add checkbox
        $sheet->setCellValue('E' . $row, 'FALSE');
        $sheet->getCell('E' . $row)->getDataValidation()
            ->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)
            ->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION)
            ->setAllowBlank(false)
            ->setShowInputMessage(true)
            ->setShowErrorMessage(true)
            ->setShowDropDown(true)
            ->setFormula1('"TRUE,FALSE"');

        // Apply borders and formatting
        $sheet->getStyle('A' . $row . ':E' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B' . $row . ':C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set row height to accommodate all details without wrapping
        $sheet->getRowDimension($row)->setRowHeight(-1);

        $row++;
    }

    // Auto-size columns
    foreach (range('A', 'E') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Set print area
    $sheet->getPageSetup()->setPrintArea('A1:E' . ($row - 1));

    // Apply professional styling
    $sheet->getStyle('A1:E' . ($row - 1))->getFont()->setName('Arial')->setSize(10);
    $sheet->getStyle('A8:E' . ($row - 1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('D9:D' . ($row - 1))->getAlignment()->setWrapText(true);

    // Add subtle alternating row colors
    for ($i = 9; $i < $row; $i += 2) {
        $sheet->getStyle('A' . $i . ':E' . $i)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFAFAFA');
    }

    // Generate a unique filename
    $filename = $projectName . '_timeline_' . uniqid() . '.xlsx';

    // Set the directory for saving files
    $uploadDir = 'downloads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . $filename;

    // Save the Excel file
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    // Return JSON response with file URL
    $fileUrl = 'downloads/' . $filename; // Adjust this if your server configuration requires a different URL
    echo json_encode([
        'success' => true,
        'file_url' => $fileUrl
    ]);
    exit;
} else {
    echo json_encode([
        'success' => false,
        'message' => "Invalid request method."
    ]);
    exit;
}
