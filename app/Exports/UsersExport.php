<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    private $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users->map(function ($user) {
            return [
                'ID' => $user->id,
                'First name' => $user->first_name,
                'Last name' => $user->last_name,
                'Title' => $user->title,
                "الاسم الرباعي - بالعربي" => $user->fourth_name_in_arabic,
                'Passport/ ID number' => $user->passport,
                'Hospital/Department' => $user->hospital,
                'Speciality' => $user->specialty,
                'Phone number' => $user->mobile,
                'Email' => $user->email,
                'Created At' => Carbon::parse($user->created_at)->format('Y-m-d'),
                'Training hours' => $user->getTotalTrainingHoursAttribute(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'First name',
            'Last name',
            'Title',
            "الاسم الرباعي - بالعربي",
            "Passport/ ID number",
            'Hospital/Department',
            'Speciality',
            'Phone number',
            'Email',
            'Created At',
            'Training hours'
        ];
    }
}
