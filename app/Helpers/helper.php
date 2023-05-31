<?php

use Carbon\Carbon;
use App\Models\Proposal;
use Illuminate\Support\Str;
use App\Models\ProposalItem;
use App\Models\StatusProposalFinal;

if (! function_exists('rejectedStatus')) {
    function rejectedStatus() {
		$rejectedStatus = [
			"REJECTED - Timeline less than 45 days",
			"REJECTED",
			"CANCEL",
			"REJECTED - Unsuitable brand"
		];
        return $rejectedStatus;
    }
}

if (! function_exists('onProgressStatus')) {
    function onProgressStatus() {
		$onProgressStatus = StatusProposalFinal::all();
		$pulled = [];
		$to_remove = array('REJECTED');
		foreach($onProgressStatus as $data) {
			array_push($pulled, $data->status);
		}
		array_push($pulled, "ONPROGRESS");
		$filtered = array_diff($pulled, $to_remove);
		$flattened = Arr::flatten($filtered);

		return $flattened;
    }
}

if (! function_exists('totalProposalOnSubmited')) {
    function totalProposalOnSubmited() {
        $status = ['REJECTED', 'FORWARD TO OTHER FUNCTION', 'DONE', 'CANCEL'];
		$proposalItem = ProposalItem::with(['proposal', 'proposal.user'])->whereNotIn('status_item', $status)->count();
        return $proposalItem;
    }
}

if (! function_exists('totalProposalOnProgress')) {
    function totalProposalOnProgress() {
		$proposal = Proposal::where('status', 'ONPROGRESS')->count();
        return $proposal;
    }
}

if (! function_exists('datePassed')) {
    function datePassed($targetDate) {
        if(Carbon::now()->lessThan($targetDate)) {
            return "belum_lewat";
        } else {
            return "sudah_lewat";
        }
    }
}

if (! function_exists('nowYear')) {
    function nowYear() {
        return now()->format("Y");
    }
}

if (! function_exists('nowYearMinusOne')) {
    function nowYearMinusOne() {
        return now()->format("Y") - 1;
    }
}

if (! function_exists('nowToday')) {
    function nowToday() {
        return now()->format("Y-m-d");
    }
}

if (! function_exists('nowTodayIndonesia')) {
    function nowTodayIndonesia() {
        return now()->format("d-m-Y");
    }
}

if (! function_exists('extractDateRange')) {
    function extractDateRange($start, $end) {
        return CarbonPeriod::create($start, $end);
    }
}

if (! function_exists('limitText')) {
    function limitText($string, $textLenght) {
        return Str::limit($string, $textLenght);
    }
}

if (! function_exists('slugTitle')) {
    function slugTitle($string) {
        return Str::slug($string, '-');
    }
}

if (! function_exists('upperCase')) {
    function upperCase($string) {
        return Str::upper($string);
    }
}

if (! function_exists('lowerCase')) {
    function lowerCase($string) {
        return Str::lower($string);
    }
}

if (! function_exists('firstUpper')) {
    function firstUpper($string) {
        return Str::ucfirst(Str::lower($string));
    }
}

if (! function_exists('humanDateRead')) {
    function humanDateRead($date) {
        return Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
    }
}

if (! function_exists('dayNameIndonesia')) {
    function dayNameIndonesia($timestamp) {
        return Carbon::parse($timestamp)->isoFormat('dddd');
    }
}

if (! function_exists('indonesianDate')) {
    function indonesianDate($timestamp) {
        return Carbon::parse($timestamp)->format('d M Y');
    }
}

if (! function_exists('indonesianFullDayAndDate')) {
    function indonesianFullDayAndDate($timestamp) {
		return Carbon::parse($timestamp)->isoFormat('dddd, D MMMM Y')." ".now()->format("h:i:s"); //Rabu, 24 Mei 2023 09:40:21
    }
}

if (! function_exists('customName')) {
    function customName($name = null) {
		$timestamp = now()->format("Y-m-d");
		if(is_null($name)) {
			$output = slugTitle(Carbon::parse($timestamp)->isoFormat('dddd, D MMMM Y')." ".now()->format("h:i:s"));
		} else {
			$output = slugTitle($name."-".Carbon::parse($timestamp)->isoFormat('dddd, D MMMM Y')." ".now()->format("h:i:s"));
		}
		return $output;//Rabu, 24 Mei 2023 09:40:21
    }
}

if (! function_exists('simpleCustomName')) {
    function simpleCustomName($name = null) {
		$timestamp = now()->format("Y-m-d");
		if(is_null($name)) {
			$output = slugTitle(Carbon::parse($timestamp)->isoFormat('D MMMM Y'));
		} else {
			$output = slugTitle($name.Carbon::parse($timestamp)->isoFormat('D MMMM Y'));
		}
		return $output;
    }
}

if (! function_exists('indonesiaDayAndDate')) {
    function indonesiaDayAndDate($timestamp) {
        return Carbon::parse($timestamp)->isoFormat('dddd, D MMMM Y'); //Sabtu, 30 Oktober 2021
    }
}

if (! function_exists('indonesiaDate')) {
    function indonesiaDate($timestamp) {
        return Carbon::parse($timestamp)->isoFormat('D MMMM Y'); //30 Oktober 2021
    }
}

if (! function_exists('indonesiaDateWithCity')) {
    function indonesiaDateWithCity($timestamp) {
        return "Jakarta, ".Carbon::parse($timestamp)->isoFormat('D MMMM Y'); //30 Oktober 2021
    }
}

if (! function_exists('indonesiaShortDayAndDate')) {
    function indonesiaShortDayAndDate($timestamp) {
        return Carbon::parse($timestamp)->isoFormat('D MMM Y');
    }
}

if (! function_exists('indonesianDateTime')) {
    function indonesianDateTime($timestamp) {
        return Carbon::parse($timestamp)->format('d M Y h:i:s A');
    }
}

if (! function_exists('dateOnly')) {
    function dateOnly($timestamp) {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }
}

if (! function_exists('yearOnly')) {
    function yearOnly($timestamp) {
        return Carbon::parse($timestamp)->format('Y');
    }
}

if (! function_exists('yearMinusOneOnly')) {
    function yearMinusOneOnly($timestamp) {
        $out = Carbon::parse($timestamp)->format('Y');
        return $out - 1;
    }
}

if (! function_exists('monthOnly')) {
    function monthOnly($timestamp) {
        return Carbon::parse($timestamp)->format('m');
    }
}

if (! function_exists('dayOnly')) {
    function dayOnly($timestamp) {
        return Carbon::parse($timestamp)->format('d');
    }
}

if (! function_exists('timeOnly')) {
    function timeOnly($timestamp) {
        return Carbon::parse($timestamp)->format('h:i:s A');
    }
}

if (! function_exists('incrementDays')) {
    function incrementDays($timestamp, $days) {
        return Carbon::parse($timestamp)->addDays($days);
    }
}

if (! function_exists('indonesianStandart')) {
    function indonesianStandart($timestamp) {
        return Carbon::parse($timestamp)->format('d-m-Y');
    }
}

if (! function_exists('countDays')) {
    function countDays($start, $end) {
        return Carbon::parse($end)->diffInDays($start) + 1;
    }
}
