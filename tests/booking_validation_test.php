<?php
require __DIR__ . '/../includes/booking_helpers.php';

$cases = [
    [
        'name' => 'valid booking request',
        'data' => [
            'guest_name' => 'Nimal Perera',
            'guest_email' => 'nimal@example.com',
            'check_in' => '2026-08-01',
            'check_out' => '2026-08-03',
            'travelers' => 2,
        ],
        'expected_errors' => 0,
    ],
    [
        'name' => 'missing required fields and invalid dates',
        'data' => [
            'guest_name' => '',
            'guest_email' => 'not-an-email',
            'check_in' => '2026-08-04',
            'check_out' => '2026-08-03',
            'travelers' => 0,
        ],
        'expected_errors' => 4,
    ],
];

$passed = 0;
foreach ($cases as $case) {
    $result = validateBookingInput($case['data']);
    $errors = count($result['errors']);
    $ok = $errors === $case['expected_errors'];
    echo ($ok ? 'PASS' : 'FAIL') . ' - ' . $case['name'] . PHP_EOL;
    if (!$ok) {
        echo '  Expected ' . $case['expected_errors'] . ' errors but got ' . $errors . PHP_EOL;
    } else {
        $passed++;
    }
}

if ($passed !== count($cases)) {
    exit(1);
}

echo 'All booking validation tests passed.' . PHP_EOL;
