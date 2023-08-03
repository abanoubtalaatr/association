<?php

namespace App\Http\Livewire\Admin\Course;

use App\Imports\UsersImport;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Tcpdf\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;


class Edit extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form, $page_title, $picture, $course, $csvFile, $records;

    public $attendSelectedUsers = [];
    public $selectAll = false;

    public function mount(Course $course)
    {
        $this->course = $course;

        $this->form = Arr::except($course->toArray(), ['updated_at', 'created_at', 'id']);
        $this->form['date'] = Carbon::parse($this->course->date)->format('Y-m-d');
        $this->form['valid_to'] = Carbon::parse($this->course->valid_to)->format('Y-m-d');
        $this->page_title = __('site.edit_course');
    }


    public function attendCourseTrainer($userId)
    {
        $row = CourseUser::query()
            ->where('user_id', $userId)
            ->where('course_id', $this->course->id)
            ->first();

        $row->update(['attend_course' => !$row->attend_course]);
    }

    public function passCourseTrainer($userId)
    {
        $row = CourseUser::query()
            ->where('user_id', $userId)
            ->where('course_id', $this->course->id)
            ->first();

        $row->update(['pass_course' => !$row->pass_course]);
    }

    public function deleteItem(User $user)
    {
        // Detach the user from the course
        $this->course->users()->detach($user);
        $checkDir = 'uploads/pics/certifications/users/' . $user->id . '/' . $this->course->id;

        if (File::isDirectory($checkDir)) {
            File::deleteDirectory($checkDir);
        }

        $this->emit('reloadComponent');
    }

    // this user for import the users for course for the firs time or the same file put added new columns
    public function import()
    {

        $this->validate();

        if ($this->csvFile) {

            $path = $this->csvFile->store('imports');

            Excel::import(new UsersImport($this->course), Storage::path($path));
        }
        return redirect()->to(route('admin.course.edit', $this->course->id));

    }

    public function store()
    {
        $this->validate();

        $this->course->update($this->form);
        session()->flash('success_message', __('site.saved_successfully'));
        return redirect()->to(url('admin/courses'));
    }

    public function getRules()
    {
        return [
            'form.name' => 'required|max:300',
            'form.description' => 'required|max:300',
            'form.date' => 'required|date',
            'form.valid_to' => 'required|date',
            'form.training_hours' => 'required'
        ];
    }

    public function printCertifications()
    {
        $certification = $this->course->certification;
        $this->message = null;
        if ($certification) {
            if ($this->course->users()->where('attend_course', 1)->where('pass_course', 1)->count() > 0) {
                $trainers = $this->course->users()->where('attend_course', 1)->where('pass_course', 1)->get();
                $zipPath = public_path('certifications.zip');
                if (File::exists($zipPath)) {
                    File::delete($zipPath);
                }

                $zip = new \ZipArchive();
                $zipName = 'certifications.zip';
                $zipPath = public_path($zipName);
                if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {

//                    $checkDir = 'uploads/pics/certifications/users/' . $trainer->id . '/' . $this->course->id;
//                    if (File::isDirectory($checkDir)) {
//                        File::deleteDirectory($checkDir);
//                    }
                    foreach ($trainers as $trainer) {
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
                        $directory = '\\uploads/pics/certifications/users/' . $trainer->id . '/' . $this->course->id;
                        $checkDir = 'uploads/pics/certifications/users/' . $trainer->id . '/' . $this->course->id;
                        if (File::isDirectory($checkDir)) {
                            File::deleteDirectory($checkDir);
                        }
                        // Create the trainer's folder if it doesn't exist
                        if (!File::isDirectory($checkDir)) {
                            File::makeDirectory($checkDir, 0777, true, true);
                        }

                        $fileName = $directory . '/' . $trainer->random_url . '.pdf';

                        $certificationName = $directory . '/' . $trainer->random_url ;
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
                        $pdf->Text($nameX, $nameY, $trainer->first_name . ' '. $trainer->last_name);

                        // Output the modified PDF content to a new file with the QR code and text added
                        $pdf->Output(public_path($fileName), 'F');

                        // Add the PDF file to the zip archive
                        $zip->addFile(public_path($fileName), $trainer->first_name .' ' .$trainer->last_name . '.pdf');
                    }

                    // Close the zip archive
                    $zip->close();

                    // Create the download response
                    $headers = [
                        'Content-Disposition' => 'attachment; filename="' . $zipName . '"',
                        'Content-Type' => 'application/zip',
                    ];
                    return response()->download($zipPath, $zipName, $headers);
                } else {
                    $this->message = __('site.failed_to_create_zip_file');
                }
            } else {
                $this->message = __('site.no_user_can_get_certification_now');
            }
        } else {
            $this->message = __('site.must_create_certification_first');
        }
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


    public function render()
    {
        $this->records = $this->course->users;

        return view('livewire.admin.course.edit')->layout('layouts.admin');
    }
}
