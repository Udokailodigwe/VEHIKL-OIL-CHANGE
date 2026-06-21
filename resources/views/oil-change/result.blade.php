@extends('layouts.app')

@section('title', 'Oil Change Result')

@section('content')
    @if ($check->is_due_for_oil_change)
        <p>Your car is due for an oil change.</p>
    @else
        <p>Your car is not due for an oil change.</p>
    @endif

    <p>{{ $check->current_odometer }}</p>
    <p>{{ $check->previous_odometer }}</p>
    <p>{{ $check->previous_change_date->format('Y-m-d') }}</p>

    <a href="{{ route('home') }}">Check another car</a>
@endsection
