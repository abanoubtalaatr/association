<?php


namespace App\Services;

use setasign\Fpdi\Tcpdf\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;


class CertificationService
{
    public function storeCertificationForUser($user, $course)
    {
        //store it with his name in folder
        $certification = $course->certification;
        $file = $certification->file;
        $pdfPath = public_path('uploads/pics' . '/' . $file);

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfPath);
        $templateId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        $barcodeX = $certification->position_x_barcode;
        $barcodeY = $certification->position_y_barcode;
        $nameX = $certification->position_x_person_name;
        $nameY = $certification->position_y_person_name;
        $fontSize = $certification->font_of_name;
        $colorOfName = $certification->name_of_color;
        $barcodeWidth = $certification->barcode_width;
        $barcodeHeight = $certification->barcode_height;

        // Generate a unique directory name based on current timestamp and trainer's ID
        $directory = '\\uploads/pics/certifications/users/' . $user->id . '/' . $course->id;
        $checkDir = 'uploads/pics/certifications/users/' . $user->id . '/' . $course->id;
        if (File::isDirectory($checkDir)) {
            File::deleteDirectory($checkDir);
        }
        // Create the trainer's folder if it doesn't exist
        if (!File::isDirectory($checkDir)) {
            File::makeDirectory($checkDir, 0777, true, true);
        }

        $fileName = $directory . '/' . $user->random_url . '.pdf';

        $certificationName = $directory . '/' . $user->random_url;
        // Get the base URL of your application
        $baseUrl = url('/');

        // Append the $fileName to the base URL to create the complete URL
        $pdfUrl = $baseUrl . $certificationName;

        // Generate the QR code image using simple-qrcode package
        $qrcode = QrCode::format('png')->size(250)->generate($pdfUrl);

        // Save the QR code image to a temporary file
        $qrcodeImagePath = tempnam(sys_get_temp_dir(), 'qrcode');
        imagepng(imagecreatefromstring($qrcode), $qrcodeImagePath);

        // Insert the QR code image into the PDF using GD
        $pdf->Image($qrcodeImagePath, $barcodeX, $barcodeY, $barcodeWidth, $barcodeHeight);

        // Convert the hex color value to RGB values
        $textColorRGB = $this->hex2rgb($colorOfName);

        // Set the text color to the color passed as a parameter
        $pdf->SetTextColor($textColorRGB[0], $textColorRGB[1], $textColorRGB[2]);

        $pdf->SetFont('Helvetica', '', $fontSize);

        // Add the text to the PDF with the dynamic color
        $pdf->Text($nameX, $nameY, $user->first_name . ' ' . $user->last_name);

        // Output the modified PDF content to a new file with the QR code and text added
        $pdf->Output(public_path($fileName), 'F');
    }

    public function downloadPdf($fileName, $path)
    {
        $headers = [
            'Content-Disposition' => 'attachment; filename="' . $fileName. '"',
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($path, $fileName, $headers);
    }

    function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return array($r, $g, $b);
    }
}
