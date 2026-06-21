@extends('layouts.app')

@section('title', 'Oil Change Check')

@section('content')
    <h1>Oil Change Check</h1>

    <form method="POST" action="{{ route('check.store') }}">
        @csrf

        <div class="field">
            <label for="current_odometer">Current Odometer</label>
            <input
                type="number"
                name="current_odometer"
                id="current_odometer"
                value="{{ old('current_odometer') }}"
            >
            @error('current_odometer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="previous_odometer">Previous Odometer</label>
            <input
                type="number"
                name="previous_odometer"
                id="previous_odometer"
                value="{{ old('previous_odometer') }}"
            >
            @error('previous_odometer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="previous_change_date">Date of Previous Oil Change</label>
            <input
                type="date"
                name="previous_change_date"
                id="previous_change_date"
                value="{{ old('previous_change_date') }}"
            >
            @error('previous_change_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Check</button>
    </form>
@endsection
