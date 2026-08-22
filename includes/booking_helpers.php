<?php
function validateBookingInput(array $data): array
{
    $errors = [];
    $guestName = trim((string)($data['guest_name'] ?? ''));
    $guestEmail = trim((string)($data['guest_email'] ?? ''));
    $checkIn = trim((string)($data['check_in'] ?? ''));
    $checkOut = trim((string)($data['check_out'] ?? ''));
    $travelers = (int)($data['travelers'] ?? 1);

    if ($guestName === '') {
        $errors[] = 'Please enter your name.';
    }

    if (!filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($checkIn === '' || $checkOut === '') {
        $errors[] = 'Please select both check-in and check-out dates.';
    } else {
        $checkInDate = strtotime($checkIn);
        $checkOutDate = strtotime($checkOut);
        if ($checkInDate === false || $checkOutDate === false) {
            $errors[] = 'Please use valid calendar dates.';
        } elseif ($checkOutDate <= $checkInDate) {
            $errors[] = 'Check-out must be after check-in.';
        }
    }

    if ($travelers < 1) {
        $errors[] = 'Please include at least one traveler.';
    }

    return [
        'errors' => $errors,
        'guest_name' => $guestName,
        'guest_email' => $guestEmail,
        'check_in' => $checkIn,
        'check_out' => $checkOut,
        'travelers' => $travelers,
    ];
}

function getBookingStatusLabel(string $status): string
{
    return match ($status) {
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
        'completed' => 'Completed',
        default => 'Pending',
    };
}

function getBookingStatusOptions(): array
{
    return [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];
}
