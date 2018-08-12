@extends('layouts.admin.master')

@section('title', 'Employee Page')
@section('employees', 'active')
@section('ionicon')
    <ion-icon name="people"></ion-icon>
@endsection
@section('url', 'employees')
@section('page', $employee->job->name)

