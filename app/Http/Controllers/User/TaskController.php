<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller{
    public function index(){
        $data = [
            'page_title'=>__('site.tasks'),
            'records'=>Task::whereStatus('active')->where('id','<=',auth()->user()->task_level+1)->paginate()
        ];
        return view('front.user.tasks',$data);
    }

    public function show(Task $task){
        $user = auth('users')->user();
        if($user->task_level<$task->id){
            // $user->update(['task_level'=>$task->id]);
        }

        $data  = [
            'page_title'=>$task->title,
            'record'=>$task
        ];
        return view('front.user.task',$data);
    }

    public function userComplete($task){
        $user = auth('users')->user();
        if($user->task_level<$task){
            // $user->update(['task_level'=>$task+1]);
            if($user->task_level == 0){
             $user->update(['task_level'=>1]);                
            }
            // elseif($user->task_level == 1){
            //  $user->update(['task_level'=>2]);                
            // }elseif($user->task_level == 2){
            //  $user->update(['task_level'=>3]);                
            // }
            
        }
        return response()->json();
    }
}
