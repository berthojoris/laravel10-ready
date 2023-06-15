<?php

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\IndonesianHoliday;

if (! function_exists('rejectedAndCancelOnly')) {
    function rejectedAndCancelOnly() {
		$status = ['REJECTED', 'CANCELED'];
        return $status;
    }
}

if (! function_exists('excludeStatusOnLeftMenuCount')) {
    function excludeStatusOnLeftMenuCount() {
		$status = ['REJECTED', 'FORWARD TO OTHER FUNCTION', 'DONE', 'CANCELED'];
        return $status;
    }
}

if (! function_exists('rejectedStatus')) {
    function rejectedStatus() {
		$rejectedStatus = [
			"REJECTED - Timeline less than 45 days",
			"REJECTED",
			"CANCELED",
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

if (! function_exists('rejectionLetterName')) {
    function rejectionLetterName($name = null) {
		$timestamp = now()->format("Y-m-d");
		if(is_null($name)) {
			$output = slugTitle("confirmation-letter");
		} else {
			$output = slugTitle("confirmation-letter-".$name);
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

if (! function_exists('date_range')) {
	function date_range(Carbon\Carbon $from, Carbon\Carbon $to, $inclusive = true) {
		if ($from->gt($to)) {
			return null;
		}

		// Clone the date objects to avoid issues, then reset their time
		$from = $from->copy()->startOfDay();
		$to = $to->copy()->startOfDay();

		// Include the end date in the range
		if ($inclusive) {
			$to->addDay();
		}

		$step = Carbon\CarbonInterval::day();
		$period = new DatePeriod($from, $step, $to);

		// Convert the DatePeriod into a plain array of Carbon objects
		$range = [];

		foreach ($period as $day) {
			$range[] = new Carbon\Carbon($day);
		}

		return ! empty($range) ? $range : null;
	}
}

if (! function_exists('getWorkingDays')) {
	function getWorkingDays($startdate, $buisnessdays, $holidays, $dateformat="Y-m-d") {
		$i=1;
		$dayx = strtotime($startdate);
		while($i < $buisnessdays) {
			$day = date('N', $dayx);
			$date = date('Y-m-d', $dayx);
			if($day < 6 && !in_array($date, $holidays))$i++;
			$dayx = strtotime($date.' +1 day');
		}
		return date($dateformat,$dayx);
	}
}

if (! function_exists('removeZeroChar')) {
	function removeZeroChar($value) {
		if(strlen((string)$value) == 2) {
			$str = ltrim($value, '0');
			return $str;
		} else {
			return $value;
		}
	}
}

if (! function_exists('createDailyInput')) {
	function createDailyInput($id) {
		$proposalItem = ProposalItem::with('proposal')->findOrFail($id);

		$awal = $proposalItem->proposal->tanggal_diproses;
		$akhir = $proposalItem->proposal->deadline_sop;

		$d_start = removeZeroChar(Carbon::parse($awal)->format("d"));
		$m_start = removeZeroChar(Carbon::parse($awal)->format("m"));
		$y_start = Carbon::parse($awal)->format("Y");

		$d_end = removeZeroChar(Carbon::parse($akhir)->format("d"));
		$m_end = removeZeroChar(Carbon::parse($akhir)->format("m"));
		$y_end = Carbon::parse($akhir)->format("Y");

		$start = Carbon::now()->setDate($y_start, $m_start, $d_start);
		$end = Carbon::now()->setDate($y_end, $m_end, $d_end);

		$holidays = [];
		$pullDate = [];

		$days = $start->diffInDaysFiltered(function (Carbon $date) use ($holidays, $pullDate, $id) {
			if($date->isWeekday() && !in_array($date->format("Y-m-d"), $holidays)) {
				// array_push($pullDate, $date->format("Y-m-d"));
				DailyProgress::create([
					'proposal_item_id' => $id,
					'day' => $date->format("Y-m-d"),
					'note' => '-'
				]);
			}

			return $date->isWeekday() && !in_array($date, $holidays);

		}, $end);

		return $days;
	}
}

if (! function_exists('moneyFormat')) {
	function moneyFormat($val, $sym=null) {
		$regex = "/\B(?=(\d{3})+(?!\d))/i";
		if(is_null($sym)) {
			$rupiah = preg_replace($regex, ",", $val);
		} else {
			$rupiah = $sym . preg_replace($regex, ",", $val);
		}

		return $rupiah;
	}
}

if (! function_exists('removeAlphaChar')) {
	function removeAlphaChar($string) {
		return preg_replace('/[^0-9]/', '', $string);
	}
}

if (! function_exists('addDaysWithoutWeeks')) {
	function addDaysWithoutWeeks($dateTimeString='', $days=0) {
		$date = Carbon::createFromFormat('Y-m-d', $dateTimeString, 'Asia/Jakarta');
		return $date->addWeekdays($days)->format("Y-m-d");
	}
}

if (! function_exists('addDaysWithoutWeeksAndHolidays')) {
	function addDaysWithoutWeeksAndHolidays($date, $count=0) {
		// https://raviyatechnical.medium.com/laravel-carbon-add-number-of-days-excluding-weekends-and-custom-dates-33546c4cdff8

		$holidays = IndonesianHoliday::select('tanggal')->get();
		$arr_holiday = [];
		foreach($holidays as $holiday) {
			array_push($arr_holiday, $holiday->tanggal);
		}

        $MyDateCarbon = Carbon::parse($date);
        $MyDateCarbon->addWeekdays($count);

        for ($i = 1; $i <= $count; $i++) {
            if (in_array(Carbon::parse($date)->format("Y-m-d"), $arr_holiday)) {
                $MyDateCarbon->addDay();
            }
        }

        return $MyDateCarbon->format("d-m-Y");
	}
}