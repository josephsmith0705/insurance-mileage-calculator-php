<?php

declare(strict_types=1);
final class InsuranceMileageCalculator
{
    public static function validate(array $post) : array
    {
        $errors = [];
        if (empty($post['startDate'])) {
            $errors['startDate'] = 'Please enter a start date';
        }
        if (empty($post['miles'])) {
            $errors['startDate'] = 'Please enter a value for miles';
        }
        if (empty($post['maxMiles'])) {
            $errors['startDate'] = 'Please enter a value for maxMiles';
        }

        return $errors;
    }

    public static function calculate(array $post) : array
    {
        $remainingMiles = static::calculateRemainingMiles((int)$post['miles'], (int)$post['maxMiles']);
        $milesProgress = static::calculateMilesProgress((int)$post['miles'], (int)$post['maxMiles']);
        $yearProgress = static::calculateYearProgress($post['startDate']);

        return [
            'remainingMiles' => $remainingMiles,
            'milesProgress' => static::formatPercentage($milesProgress),
            'yearProgress' => static::formatPercentage($yearProgress),
        ];
    }

    private static function formatPercentage(float $decimal): string
    {
        return round($decimal * 100) . '%';
    }

    private static function calculateMilesProgress(int $miles, int $maxMiles): float
    {
        return $miles / $maxMiles;
    }

    private static function calculateYearProgress(string $startDate): float
    {
        $startDate = new DateTime($startDate);
        $currentDate = new DateTime();

        $interval = date_diff($currentDate, $startDate);
        return $interval->days / 365;
    }

    private static function calculateRemainingMiles(int $miles, int $maxMiles): int
    {
        return $maxMiles - $miles;
    }
}