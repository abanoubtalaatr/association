<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use Maatwebsite\Excel\Validators\ValidationException;


class UsersImport implements ToCollection
{
    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function collection(Collection $rows)
    {
        $data = $rows->slice(1);

        foreach ($data as $row) {

            $userRow = User::query()->where('passport', $row[4])->first();
            if(!$row[0] && !$row[1] && !$row[2] && !$row[3] && !$row[4] && !$row[5] && !$row[6] && !$row[7] && !$row[8]){

            }else{
                if (is_null($userRow)) {
                    $user = new User();
                    $user->title = $row[0];
                    $user->first_name = $row[1];
                    $user->last_name = $row[2];
                    $user->fourth_name_in_arabic = $row[3];
                    $user->passport = $row[4];
                    $user->city = $row[5];
                    $user->hospital = $row[6];
                    $user->specialty = $row[7];
                    $user->mobile = $row[8];
                    $user->email = $row[9];
                    $user->password = Hash::make('123456789');

                    $user->random_url = Str::random(64);

                    $user->save();

                    $userSubscribe = CourseUser::query()
                        ->where('course_id', $this->course->id)
                        ->where('user_id', $user->id)->first();
                    if (!$userSubscribe) {
                        CourseUser::query()->create(['user_id' => $user->id, 'course_id' => $this->course->id]);
                    }
                } else {
                    $userSubscribe = CourseUser::query()->where('course_id', $this->course->id)->where('user_id', $userRow->id)->first();
                    if (!$userSubscribe) {
                        CourseUser::query()->create(['user_id' => $userRow->id, 'course_id' => $this->course->id]);
                    }
                }
            }
        }
    }
}
