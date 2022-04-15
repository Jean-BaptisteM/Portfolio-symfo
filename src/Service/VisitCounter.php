<?php

namespace App\Service;

class VisitCounter
{
    public function addVisit(): void
    {
        $file = $_ENV['DATA_VISIT_COUNTER'];
        $dailyFile = $file . '-' . date('Y-m-d');
        $this->incrementCounter($file);
        $this->incrementCounter($dailyFile);
    }

    public function incrementCounter(string $file): void
    {
        $counter = 1;
        if (file_exists($file)) {
            $counter = (int)file_get_contents($file);
            $counter++;
        }
        file_put_contents($file, $counter);
    }

    public function viewsTotalNumber(): string
    {
        $file = $_ENV['DATA_VISIT_COUNTER'];
        if (file_exists($file)) {
            return file_get_contents($file);
        } else {
            return '0';
        }
    }

    public function viewsCurrentYearNumber(): int
    {
        $file = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y') . '-' . '*' . '-' . '*';
        if ($file !== false) {
            $files = glob($file);
            $currentYearViews = 0;
            foreach ($files as $file) {
                $currentYearViews += (int)file_get_contents($file);
            }
            return $currentYearViews;
        } else {
            return '0';
        }
    }

    public function viewsCurrentMonthNumber(): int
    {
        $file = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m') . '-' . '*';
        if ($file !== false) {
            $files = glob($file);
            $currentMonthViews = 0;
            foreach ($files as $file) {
                $currentMonthViews += (int)file_get_contents($file);
            }
            return $currentMonthViews;
        } else {
            return '0';
        }
    }

    public function viewsPreviousMonthNumber(): int
    {
        $file = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m', strtotime('-1 months')) . '-' . '*';
        if ($file !== false) {
            $files = glob($file);
            $previousMonthViews = 0;
            foreach ($files as $file) {
                $previousMonthViews += (int)file_get_contents($file);
            }
            return $previousMonthViews;
        } else {
            return '0';
        }
    }

    public function viewsDailyNumber()
    {   
        $counter = 0;
        $dailyFile = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m-d');
        if (file_exists($dailyFile)) {
            return file_get_contents($dailyFile);
        }
        file_put_contents($dailyFile, $counter);
    }

    public function viewsDailyDiff(): string
    {
        $currentDailyFile = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m-d');
        $yesterdayDailyFile = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m-d', strtotime('-1 days'));
        if (file_exists($yesterdayDailyFile)) {
            $diffViews = (int)file_get_contents($currentDailyFile) - (int)file_get_contents($yesterdayDailyFile);
            return $diffViews;
        } else {
            $diffViews = (int)file_get_contents($currentDailyFile);
            return $diffViews;
        }
    }

    public function viewsMonthDiff(): string
    {
        $currentMonthFile = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m') . '-' . '*';
        $previousMonthFile = $_ENV['DATA_VISIT_COUNTER'] . '-' . date('Y-m', strtotime('-1 months')) . '-' . '*';
        if (($currentMonthFile !== false) && ($previousMonthFile !== false)) {

            $currentMonthFiles = glob($currentMonthFile);
            $currentMonthViews = 0;
            foreach ($currentMonthFiles as $currentMonthFile) {
                $currentMonthViews += (int)file_get_contents($currentMonthFile);
            }

            $previousMonthFiles = glob($previousMonthFile);
            $previousMonthViews = 0;
            foreach ($previousMonthFiles as $previousMonthFile) {
                $previousMonthViews += (int)file_get_contents($previousMonthFile);
            }
            $viewsMonthDiff = $currentMonthViews - $previousMonthViews;
            return $viewsMonthDiff;
        } else {
            return '0';
        }
    }
}
