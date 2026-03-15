<?php

namespace App\Helpers;

use App\DTOs\RowDTO;
use App\DTOs\TableDTO;
use App\Enums\Status;
use App\Filament\Resources\Employees\Pages\HourReport;
use App\Models\ClockIn;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Collection;

final class ReportHelper
{
    private function __construct() {}

    /**
     * @param string $month Format: Y-m
     * @param Collection $employees Collection of Employee models
     * @throws \Exception
     */
    public static function monthlyEmployeeReport(string $month, Collection $employees): TableDTO
    {
        if ($employees->isEmpty()) {
            return new TableDTO(
                [__('Medewerker ID'),__('Naam'),__('Achternaam'), __('Gewerkt uren')],__('Dagen'),
                [] // Empty array for rows
            );
        }

        try {
            $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();
        } catch (\Exception $e) {
            throw new \Exception("Invalid month format. Expected Y-m.");
        }

        // Fetch valid shifts using standard Eloquent (fully compatible with PostgreSQL)
        $clockIns = ClockIn::query()
            ->whereIn('employee_id', $employees->pluck('id'))
            ->whereBetween('clock_in_time', [$startOfMonth, $endOfMonth])
            ->whereNotNull('clock_out_time')
            ->where('status', Status::Done->value) // Only process completed shifts
            ->get()
            ->groupBy('employee_id');

        $rows = [];

        $employees = $employees->sortBy('employee_id');
        foreach ($employees as $employee) {
            $employeeClockIns = $clockIns->get($employee->id, collect());

            $workedDates = [];
            $totalSeconds = 0;

            foreach ($employeeClockIns as $shift) {
                // Ensure we are working with Carbon instances
                $in = Carbon::parse($shift->clock_in_time);
                $out = Carbon::parse($shift->clock_out_time);

                // Add the duration of this specific shift
                $totalSeconds += $in->diffInSeconds($out);

                // Collect all unique calendar days this shift touches
                $currentDay = $in->copy()->startOfDay();
                $endDay = $out->copy()->startOfDay();

                while ($currentDay->lte($endDay)) {
                    // Using the date string as a key ensures uniqueness
                    $workedDates[$currentDay->toDateString()] = true;
                    $currentDay->addDay();
                }
            }

            $daysWorked = count($workedDates);

            $url = route('filament.admin.resources.employees.hourReport', [
                'record' => $employee->id,
                'month' => $month
            ]);
            $rows[] = new RowDTO(
                [
                    $employee->employee_id,
                    $employee->name,
                    $employee->last_name,
                    self::formatDuration($totalSeconds),
                    $daysWorked,
                ],
                $url
            );
        }

        return new TableDTO(
            [__('Medewerker ID'),__('Naam'),__('Achternaam'), __('Gewerkt uren'),__('Dagen')],
            $rows
        );
    }


    /**
     * @param string $month Format: Y-m
     * @param Employee $employee
     * @throws \Exception
     */
    public static function individualEmployeeMonthlyReport(string $month, Employee $employee): TableDTO
    {
        try {
            $startOfMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();
        } catch (\Exception $e) {
            throw new \Exception("Invalid month format. Expected Y-m.");
        }

        $clockIns = ClockIn::query()
            ->where('employee_id', $employee->id)
            ->whereBetween('clock_in_time', [$startOfMonth, $endOfMonth])
            ->whereNotNull('clock_out_time')
            ->where('status', Status::Done->value)
            ->get();

        $rows = [];
        $grandTotalSeconds = 0;
        $uniqueDaysWorked = 0;

        $currentDay = $startOfMonth->copy();
        while ($currentDay->lte($endOfMonth)) {
            $dateString = $currentDay->toDateString();

            $daySeconds = $clockIns->filter(function ($shift) use ($dateString) {
                return Carbon::parse($shift->clock_in_time)->toDateString() === $dateString;
            })->sum(function ($shift) {
                return Carbon::parse($shift->clock_in_time)->diffInSeconds(Carbon::parse($shift->clock_out_time));
            });

            if ($daySeconds > 0) {
                $rows[] = new RowDTO([
                    $currentDay->format('d/m/Y'), // Column 1: Date
                    self::formatDuration($daySeconds) // Column 2: Time Worked
                ], null);

                $grandTotalSeconds += $daySeconds;
                $uniqueDaysWorked++;
            }

            $currentDay->addDay();
        }
        $rows = array_reverse($rows);
        return new TableDTO(
            ['Date', 'Time Worked'], // Only 2 columns now
            $rows,
            [
                "Total Days: $uniqueDaysWorked", // Footer Column 1
                self::formatDuration($grandTotalSeconds) // Footer Column 2
            ]
        );
    }
    /**
     * Helper to format seconds into HH:MM
     */
    private static function formatDuration(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
