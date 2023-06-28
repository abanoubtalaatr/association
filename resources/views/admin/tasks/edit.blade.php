@extends('layouts.admin')
@section('content')
@livewire('admin.tasks.edit',['task'=>$record])
@endsection
