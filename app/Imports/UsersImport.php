<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Support\Collection;
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
            $userRow = User::query()->where('email', $row[2])->first();
            if (is_null($userRow)) {
                $user = new User();
                $user->username = $row[0];
                $user->mobile = $row[1];
                $user->email = $row[2];
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
