@extends('layouts.app')

@php
    $header = 'Frequently Asked Questions';
@endphp

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-dark shadow sm:rounded-lg">
                <x-dummy-content type="faq"  class="my-6 mx-4"/>
            </div>
        </div>
    </div>
@endsection
