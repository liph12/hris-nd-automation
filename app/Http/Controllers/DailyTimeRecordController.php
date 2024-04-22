<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;

class DailyTimeRecordController extends Controller
{
    public function formatSchedule($startTime, $endTime) {
        // Convert start and end times to DateTime objects
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);
        $isNextDay = false;

        // Check if end time is less than start time, indicating it extends to next day
        if ($end < $start) {
            // If so, add 1 day to end time
            $end->modify('+1 day');
            $isNextDay = true;
        }

        // Format the start and end times
        $formattedStartTime = $start->format('Y-m-d g:i A');
        $formattedEndTime = $end->format('Y-m-d g:i A');

        return ['startTime' => $formattedStartTime, 'endTime' => $formattedEndTime, 'isNextDay' => $isNextDay];
    }

    protected function formatTime($time)
    {
        $hours = ceil(abs($time) / 3600 * 100) / 100;
        $wholeHours = floor($hours);
        $decimalPart = ($hours - $wholeHours) * 60;
        $formattedTime = sprintf("%02d:%02d", $wholeHours, $decimalPart);

        return ['hours' => $hours, 'time' => $formattedTime];
    }
    
    // Calculate the time difference between two timestamps
    protected function getTimeDiff($timestamp1, $timestamp2)
    {
        $t1 = strtotime($timestamp1);
        $t2 = strtotime($timestamp2);
        $diff = $t1 - $t2;
        
        $isNd = ($diff) >= 0;
        $formattedTime = $this->formatTime($diff);

        $timeDiffRes = [
            'hours' => $formattedTime['hours'], 
            'time' => $formattedTime['time'], 
            'nightDiff' => $isNd
        ];

        return $timeDiffRes;
    }

    // Convert a date string into a proper date format
    protected function getProperDateFormat($date)
    {
        return date("F d, Y h:i A", strtotime($date));
    }

    protected function getProperTimeFormat($time)
    {
        return date('h:i A', strtotime($time));
    }

    // Check if the given time falls under night differential
    protected function isNightDiff($startNdTime, $timeOut)
    {
        return $this->getTimeDiff($timeOut, $startNdTime)['nightDiff'];
    }

    public function process(Request $request)
    {
        $baseDate = $request->scheduledDate;
        $schedTimeStart = $this->getProperTimeFormat($request->scheduledTimeStart);
        $schedTimeEnd = $this->getProperTimeFormat($request->scheduledTimeEnd);
        $dtrTimeIn = $this->getProperTimeFormat($request->timeIn);
        $dtrTimeOut = $this->getProperTimeFormat($request->timeOut);

        // dd($request->scheduledDate);

        if($schedTimeStart == "12:00 AM")
        {
            $dtrTimeIn = strpos($dtrTimeIn, "PM") !== false ? $schedTimeStart : $dtrTimeIn;
        }

        $nextBaseDate = $baseDate;
        $tmpBaseDate = $baseDate;

        $nDStart = "10:00 PM";
        $nDEnd = "06:00 AM";
        $dateTimeDtr = $this->formatSchedule("$baseDate $dtrTimeIn", "$baseDate $dtrTimeOut");
        $dateTimeSched = $this->formatSchedule("$baseDate $schedTimeStart", "$baseDate $schedTimeEnd");
        $isNextDay = $dateTimeDtr['isNextDay'];

        if($isNextDay)
        {
            $nextBaseDate = date('Y-m-d', strtotime("$baseDate +1 day"));
        }
        else
        {
            $tmpBaseDate = date('Y-m-d', strtotime("$baseDate -1 day"));
        }

        $dtr = [
            'basedNDTimeStart' => "$tmpBaseDate $nDStart",
            'basedNDTimeEnd' => "$nextBaseDate $nDEnd",
            'schedDate' => $baseDate,
            'schedTime' => "$schedTimeStart-$schedTimeEnd",
            'timeIn' => $dateTimeDtr['startTime'],
            'timeOut' => $dateTimeDtr['endTime']
        ];

        // dd($dtr);

        // Extract data from DTR
        $dateTimeIn = $dtr['timeIn'];
        $dateTimeOut = $dtr['timeOut'];
        $basedNDTimeStart = $dtr['basedNDTimeStart'];
        $basedNDTimeEnd = $dtr['basedNDTimeEnd'];
        $schedDate = $dtr['schedDate'];
        $schedTime = explode('-', $dtr['schedTime']);

        // Check if the time in is under night differential
        $inTimeStamp = strtotime($dateTimeIn);
        $basedNDTimeStartStamp = strtotime($basedNDTimeStart);
        $basedNDTimeEndStamp = strtotime($basedNDTimeEnd);
        $outTimeStamp = strtotime($dateTimeOut);
        $isNightDiff = $this->isNightDiff($basedNDTimeStart, $dateTimeOut);

        // Calculate time differences and format the schedule
        $currentNdStart = $basedNDTimeStart;
        $currentNdEnd = $basedNDTimeEnd;

        $currentNdStart = $inTimeStamp > $basedNDTimeStartStamp ? $dateTimeIn : $basedNDTimeStart;
        $currentNdEnd = $outTimeStamp < $basedNDTimeEndStamp ? $dateTimeOut : $basedNDTimeEnd;

        // dd($currentNdStart, $currentNdEnd);
        
        $currentDiff = $this->getTimeDiff($currentNdStart, $currentNdEnd);
        $totalNightDiff = '00:00';
        $dateTimeInTimeStamp = strtotime($dateTimeIn);
        $schedInTimeStamp = strtotime($schedDate.' '.$schedTime[0]);
        $schedOutTimeStamp = strtotime($dateTimeSched['endTime']);
        $dateTimeOutTimeStamp = strtotime($dateTimeOut);
        $isLate = $dateTimeInTimeStamp > $schedInTimeStamp;
        $isUnderTime = $schedOutTimeStamp > $dateTimeOutTimeStamp;

        // dd($isNextDay);

        if($inTimeStamp > $basedNDTimeEndStamp)
        {
            $isNightDiff = false;
        }
        
        if($isNextDay && $dateTimeSched['isNextDay'])
        {
            $nightDiffTotal = $this->getTimeDiff($basedNDTimeStart, $basedNDTimeEnd);
            $totalNightDiff = $currentDiff['hours'] >= $nightDiffTotal['hours'] ? $nightDiffTotal['time'] : $currentDiff['time'];


            if(!$isLate && !$isUnderTime)
            {
                $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, $dateTimeSched['endTime'])['time'];
            }

            if($inTimeStamp < $schedInTimeStamp)
            {
                if($inTimeStamp > $basedNDTimeStartStamp)
                {
                    $totalNightDiff = $this->getTimeDiff($dateTimeSched['startTime'], $basedNDTimeEnd)['time'];
                }

                if($schedOutTimeStamp < $basedNDTimeEndStamp)
                {
                    if($schedOutTimeStamp < $basedNDTimeEndStamp && $outTimeStamp > $schedOutTimeStamp || $outTimeStamp > $basedNDTimeEndStamp && $outTimeStamp >= $schedOutTimeStamp)
                    {
                        $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, $dateTimeSched['endTime'])['time'];
                    }
                }
            }else{
                if(!$dateTimeSched['isNextDay'])
                {
                    if($outTimeStamp > $basedNDTimeStartStamp && $outTimeStamp > $schedOutTimeStamp)
                    {
                        $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, $dateTimeSched['endTime'])['time'];
                    }
                }else{
                    if($outTimeStamp > $basedNDTimeStartStamp && $outTimeStamp > $schedOutTimeStamp && $isLate)
                    {
                        $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, $dateTimeSched['endTime'])['time'];

                        if($dateTimeOutTimeStamp < $schedOutTimeStamp)
                        {
                            $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, "$dateTimeOut")['time'];
                        }

                        if($dateTimeInTimeStamp > $basedNDTimeStartStamp && $outTimeStamp > $schedOutTimeStamp)
                        {
                            $totalNightDiff = $this->getTimeDiff($dateTimeIn, $dateTimeSched['endTime'])['time'];
                        }
                    }
                }
            }
        }   
        else
        {
            $isSchedNightDiff = $this->isNightDiff($basedNDTimeStart, $dateTimeSched['endTime']);
            $timeOutTimeStamp = strtotime("$dateTimeOut");
            $newBasedNDTimeStart = date("Y-m-d h:i A", strtotime("$basedNDTimeStart +1 day"));

            if($dateTimeSched['isNextDay'] && $isSchedNightDiff)
            {
                if($timeOutTimeStamp >= $schedOutTimeStamp)  
                {
                    $totalNightDiff = $this->getTimeDiff($newBasedNDTimeStart, $dateTimeSched['endTime'])['time'];
                }else{
                    $totalNightDiff = $this->getTimeDiff($newBasedNDTimeStart, $dateTimeOut)['time'];
                }
            }else{
                $newIsNightDiff = $this->isNightDiff($newBasedNDTimeStart, $dateTimeSched['endTime']);
                $totalNightDiff = $isNightDiff ? $currentDiff['time'] : $totalNightDiff;
                $dateSchedEndTimeStamp = strtotime($dateTimeSched['endTime']);
                $dateSchedStartTimeStamp = strtotime($dateTimeSched['startTime']);
                $tmpTotalNightDiff_ = $this->getTimeDiff($newBasedNDTimeStart, $dateTimeOut)['time'];
                $tmpTotalNightDiff = $this->getTimeDiff($newBasedNDTimeStart, $dateTimeSched['endTime'])['time'];

                if($newIsNightDiff)
                {
                    $totalNightDiff = $dateSchedEndTimeStamp >= $dateTimeOutTimeStamp ? $tmpTotalNightDiff_ : $tmpTotalNightDiff;
                }
                
                if($timeOutTimeStamp > $schedOutTimeStamp && $dateTimeInTimeStamp < $basedNDTimeStartStamp)    
                {
                    $totalNightDiff = $this->getTimeDiff($basedNDTimeStart, $dateTimeSched['endTime'])['time'];
                }
                
                if($dateSchedStartTimeStamp <= $basedNDTimeEndStamp && $dateTimeInTimeStamp <= $dateSchedStartTimeStamp && $dateTimeOutTimeStamp >= $basedNDTimeEndStamp)
                {
                    // dd($dateTimeSched['startTime'], $basedNDTimeEnd);
                    $totalNightDiff = $this->getTimeDiff($dateTimeSched['startTime'], $basedNDTimeEnd)['time'];
                }
            }
        }

        $formattedSched = $this->getProperDateFormat("$schedDate $schedTime[0]").' - '.$schedTime[1];
        $nightDiff = $totalNightDiff.'hr(s)';

        // Prepare DTR results
        $dtrResults = [
            'schedule' => $formattedSched,  
            'nextDayOut' => $isNextDay ? "Yes" : "No",
            'nightDiff' => $nightDiff,
            'timeIn' => $this->getProperDateFormat($dateTimeIn),
            'timeOut' => $this->getProperDateFormat($dateTimeOut),
            'ND_OT' => $this->getNDOT($dtr, $dateTimeSched, $dateTimeDtr)."hr(s)"
        ];

        // return $dtrResults;

        return view('dtr-form', compact('dtrResults'));    
    }

    protected function getNDOT($dtr, $sched, $dateTimeDtr)
    {
        $isSchedNightDiff = $this->isNightDiff($dtr['basedNDTimeStart'], $sched['endTime']);
        $dtrEndTimeStamp = strtotime($dtr['timeOut']);
        $schedEndTimeStamp = strtotime($sched['endTime']);
        $basedNDEndTimeStamp = strtotime($dtr['basedNDTimeEnd']);

        $NDOT = "00:00";
        $isNDOT = $isSchedNightDiff && $dtrEndTimeStamp > $schedEndTimeStamp;

        if($isNDOT)
        {
            $offSet = $dtrEndTimeStamp - $schedEndTimeStamp;

            if($dtrEndTimeStamp >= $basedNDEndTimeStamp)
            {
                if(!$dateTimeDtr['isNextDay'])
                {
                    $basedNDEndTimeStamp = $dtrEndTimeStamp;
                }

                $offSet = $schedEndTimeStamp - $basedNDEndTimeStamp;
            }

            $NDOT = $this->formatTime($offSet)['time'];
        }

        return $NDOT;
    }
}