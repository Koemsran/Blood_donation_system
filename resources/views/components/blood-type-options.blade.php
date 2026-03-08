@props([
    'selected' => null,
    'includePlaceholder' => true,
    'placeholder' => 'Select blood type',
])

@if ($includePlaceholder)
    <option value="">{{ $placeholder }}</option>
@endif

@foreach (\App\Enums\BloodType::cases() as $bloodType)
    <option value="{{ $bloodType->value }}" @selected((string) $selected === $bloodType->value)>
        {{ $bloodType->value }}
    </option>
@endforeach
