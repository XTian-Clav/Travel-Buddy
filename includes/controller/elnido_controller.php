<?php

declare(strict_types=1);

function is_elnido_input_empty(string $package_key, string $start_date, string $end_date): bool {
    return empty($package_key) || empty($start_date) || empty($end_date);
}

function is_date_range_invalid(string $start_date, string $end_date): bool {
    return strtotime($end_date) < strtotime($start_date);
}

function calculate_total_days(string $start_date, string $end_date): int {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);

    return $start->diff($end)->days + 1;
}