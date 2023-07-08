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
                'username' => $user->username,
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
            'Name',
            'Email',
            'Created At',
            'Training hours'
        ];
    }
}
