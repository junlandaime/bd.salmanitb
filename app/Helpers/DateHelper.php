<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class DateHelper
{
    /**
     * Indonesian month names mapping to English
     */
    protected static $indonesianMonths = [
        'Januari' => 'January',
        'Februari' => 'February',
        'Maret' => 'March',
        'April' => 'April',
        'Mei' => 'May',
        'Juni' => 'June',
        'Juli' => 'July',
        'Agustus' => 'August',
        'September' => 'September',
        'Oktober' => 'October',
        'November' => 'November',
        'Desember' => 'December',
    ];

    /**
     * Parse Indonesian date format to Carbon instance
     *
     * @param string $date Indonesian date string (e.g., "4 Oktober 1995")
     * @return \Carbon\Carbon
     */
    public static function parseIndonesianDate($date)
    {
        // Trim any extra whitespace
        $date = trim($date);
        
        // Split the date into parts
        $parts = explode(' ', $date);
        
        // Check if we have at least day and month
        if (count($parts) < 2) {
            return null;
        }
        
        // Get day, month and year
        $day = $parts[0];
        $month = $parts[1];
        $year = count($parts) > 2 ? $parts[2] : null;
        
        // Convert Indonesian month name to English if needed
        if (array_key_exists($month, self::$indonesianMonths)) {
            $month = self::$indonesianMonths[$month];
        }
        
        // Reconstruct the date in a format Carbon can parse
        $parsableDate = $day . ' ' . $month . ' ' . $year;
        
        try {
            return Carbon::parse($parsableDate);
        } catch (\Exception $e) {
            // If parsing fails, return null
            return null;
        }
    }

    /**
     * Calculate age from Indonesian date format
     *
     * @param string $date Indonesian date string (e.g., "4 Oktober 1995")
     * @return int|null
     */
    public static function calculateAgeFromIndonesianDate($date)
    {
        $carbon = self::parseIndonesianDate($date);
        
        if ($carbon) {
            return $carbon->age;
        }
        
        return null;
    }

    /**
     * Extract and parse the birth date from a birth place and date string
     * 
     * @param string $birthPlaceDate Format: "City, DD Month YYYY"
     * @return int|null
     */
    public static function getAgeFromBirthPlaceDate($birthPlaceDate)
    {
        // Check if the string contains a comma
        if (Str::contains($birthPlaceDate, ', ')) {
            $parts = explode(', ', $birthPlaceDate);
            if (count($parts) > 1) {
                return self::calculateAgeFromIndonesianDate($parts[1]);
            }
        }
        
        return null;
    }
}
