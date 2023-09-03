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
                'Title' => $user->title,
                'First name' => $user->first_name,
                'Last name' => $user->last_name,
                "الاسم الرباعي - بالعربي" => $user->fourth_name_in_arabic,
                'Passport/ ID number' => $user->passport,
                'City' => $user->city,
                'Hospital/ Faculty' => $user->hospital,
                'Speciality/ Department' => $user->specialty,
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
            'Title',
            'First name',
            'Last name',
            'Title',
            "الاسم الرباعي - بالعربي",
            "Passport/ ID number",
            'Hospital/ Faculty',
            'Speciality/ Department',
            'Phone number',
            'Email',
            'Created At',
            'Training hours'
        ];
    }
}
