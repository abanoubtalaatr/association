<?php

namespace App\Http\Livewire\Admin\Certification;

use App\Models\Certification;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;
use FPDF;
use setasign\Fpdi\Tcpdf\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TCPDF;


class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form, $page_title, $file, $courses, $courseId;

    public function mount()
    {
        $this->page_title = __('site.create_certification');
        $this->courses = Course::query()->whereDoesntHave('certification')->get();
        $this->form['name_of_color'] = "#202020";
        $this->form['font_of_name']= 16;
    }

    public function uploadTheFile()
    {
        $this->form['file'] = $this->file->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->file->extension(), 'public');
    }

    public function store()
    {
        $this->validate();
//        $checkCourseHaveCertification = Certification::query()->where('course_id', $this->form['course_id'])
        $this->form['file'] = $this->file->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->file->extension(), 'public');
        Certification::create($this->form);
        session()->flash('success_message', __('site.created_successfully'));
        return redirect()->to(url('admin/certifications'));
    }

    public function previewCertification()
    {
        $this->validate();
        $this->uploadTheFile();
        $barcodeX = $this->form['position_x_barcode'] ?? 150;
        $barcodeY = $this->form['position_y_barcode'] ?? 10;
        $nameX = $this->form['position_x_person_name'] ?? 120;
        $nameY = $this->form['position_y_person_name'] ?? 0;
        $barcodeWidth = $this->form['barcode_width'] ?? 30;
        $barcodeHeight = $this->form['barcode_height'] ?? 30;
        $file = $this->form['file'];
        // Set the path to the existing PDF file
        $pdfPath = public_path('uploads/pics' . '/' . $file);

        // Create a new FPDI instance
        $pdf = new Fpdi();

        $pageCount = $pdf->setSourceFile($pdfPath);
        $templateId = $pdf->importPage(1);
        $pdf->AddPage();

        $pdf->useTemplate($templateId);

        // Generate a random string to encode as a QR code
        $randomString = bin2hex(random_bytes(16));

        // Generate the QR code image using simple-qrcode package
        $qrcode = QrCode::format('png')->size(250)->generate('https://lema.org.ly');

        // Save the QR code image to a temporary file
        $qrcodeImagePath = tempnam(sys_get_temp_dir(), 'qrcode');
        imagepng(imagecreatefromstring($qrcode), $qrcodeImagePath);

        // Insert the QR code image into the PDF using GD
        $pdf->Image($qrcodeImagePath, $barcodeX, $barcodeY, $barcodeWidth, $barcodeHeight);

        // Convert the hex color value to RGB values
        $textColorRGB = $this->hex2rgb($this->form['name_of_color']);

        // Set the text color to the color passed as a parameter
        $pdf->SetTextColor($textColorRGB[0], $textColorRGB[1], $textColorRGB[2]);

        $pdf->SetFont('Helvetica', '', $this->form['font_of_name']);
        // Add the text' to the PDF with the dynamic color
        $pdf->Text($nameX, $nameY, 'Dr.Mohamed Abukalish');

        // Output the modified PDF content to a new file with the QR code and text added
        $pdf->Output(public_path('uploads/mypdf_with_qrcode.pdf'), 'F');
        $pdfUrl = url('/uploads/mypdf_with_qrcode.pdf');

        $this->emit('pdfGenerated', $pdfUrl);
    }

    function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        return array($r, $g, $b);
    }

    public function updatedFormPicture()
    {
        $this->withValidator(function (Validator $validator) {
            if ($validator->errors()->has('form.file')) {
                $this->form['file'] = '';
            }
        })->validateOnly('form.file');
    }


    public function getRules()
    {
        return [
            'form.position_x_barcode' => 'required|max:500',
            'form.position_y_barcode' => 'required|max:500',
            'form.position_x_person_name' => 'required|max:500',
            'form.position_y_person_name' => 'required|max:500',
            'form.course_id' => 'required|exists:courses,id',
            'form.name_of_color'=> 'nullable',
            'form.font_of_name' => 'nullable',
            'file' => 'required|file|mimes:pdf',
            'form.barcode_width' => 'nullable',
            'form.barcode_height' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.admin.certification.create')->layout('layouts.admin');
    }
}
