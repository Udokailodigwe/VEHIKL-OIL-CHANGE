@extends('layouts.app')

@section('title', 'Oil Change Result')

@section('content')
    <h1>Oil Change Result</h1>

    @if ($check->is_due_for_oil_change)
        <p class="message message--due">Your car is due for an oil change.</p>
    @else
        <p class="message message--not-due">Your car is not due for an oil change.</p>
    @endif

    <dl class="details">
        <dt>Current Odometer</dt>
        <dd>{{ $check->current_odometer }}</dd>

        <dt>Previous Odometer</dt>
        <dd>{{ $check->previous_odometer }}</dd>

        <dt>Date of Previous Oil Change</dt>
        <dd>{{ $check->previous_change_date->format('Y-m-d') }}</dd>
    </dl>

    <a class="button" href="{{ route('home') }}">Check another car</a>
@endsection
