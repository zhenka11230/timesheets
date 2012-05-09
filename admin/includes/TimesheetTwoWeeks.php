<?php

class TimesheetTwoWeeks {

	public $timesheet_info;
    public $timesheet_settings;

	public $start_datetime; //used to start iterator through the days
	public $num_days = 14;
	public $days = array(); //usually array of 14 timesheetoneday objects
	public $timesheet_data; //unencoded json for two weeks

	public $two_weeks_save_array_TimeModified_db = array();

    function __construct($timesheet_info, $timesheet_calculation_settings = ''){
         $this->timesheet_info = $timesheet_info;

         if(empty($timesheet_calculation_settings)){
             $timesheet_calculation_settings = new TimesheetSettings(array());
         }
         $this->timesheet_settings = $timesheet_calculation_settings;
    }

	//go through each day.  If there is data from TimeModified, get it, if not - get it from Time, if nothing in both, send empty array.
	public function init_selectively_from_db() {
		
		$timesheet_period_db = TimesheetPeriod::getTimesheetPeriods(array('timesheet_period_id' => $this->timesheet_info->get_timesheet_period_id()));
		$this->start_datetime = $timesheet_period_db[0]->start_date;

		$times_two_weeks_Time_db = Time::getTimes(array('time_range_id' => $this->timesheet_info->get_timesheet_period_id(), 'lngEmployeeID' => $this->timesheet_info->get_employee_id()));
		$times_two_weeks_TimeModified_db = TimeModified::getTimeModified(array('timesheet_period_id' => $this->timesheet_info->get_timesheet_period_id(), 'lngEmployeeID' => $this->timesheet_info->get_employee_id()));
		$two_weeks_TimesheetDay_db = TimesheetDay::getTimesheetDays(array('time_range_id' => $this->timesheet_info->get_timesheet_period_id(), 'employee_id' => $this->timesheet_info->get_employee_id()));

		for ($i = 0; $i < $this->num_days; $i++) {
			$source = 'TimeModified_db';

			$datetime_iter = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($this->start_datetime)));

			$times_one_day = $this->times_get_one_day($times_two_weeks_TimeModified_db, $datetime_iter);
			$one_day_TimesheetDay = $this->get_one_day_TimesheetDay_db($two_weeks_TimesheetDay_db, $datetime_iter);

			if (empty($times_one_day)) {
				$source = 'Time_db';
				$times_one_day = $this->times_get_one_day($times_two_weeks_Time_db, $datetime_iter);
			}

			if (!empty($one_day_TimesheetDay)) {
				if ($one_day_TimesheetDay->mark_empty) {
					$source = 'TimeModified_db'; //fixes bug with modofied displayed as no when it should be yes
					$times_one_day = array();
				}
			}

			$this->days[$i] = new TimesheetOneDay($this->timesheet_info, $this->timesheet_settings);
			$this->days[$i]->date = $datetime_iter;
			$this->days[$i]->num = $i + 1;
			$this->days[$i]->source_db = $source;
			$this->days[$i]->process_times($times_one_day, $one_day_TimesheetDay);
		}
	}

	public function get_two_weeks_save_array_TimeModified_db($only_overtime = false) {
		foreach ($this->days as $day) {
			if ($only_overtime == true) {
				if (in_array('Hours were cut off:', $day->warning) && $day->source_db == 'Time_db') {
					$day->make_save_array_TimeModified_db();
					$this->two_weeks_save_array_TimeModified_db = array_merge($this->two_weeks_save_array_TimeModified_db, $day->save_array_TimeModified_db);
				}
			} else {
				$day->make_save_array_TimeModified_db();
				$this->two_weeks_save_array_TimeModified_db = array_merge($day->save_array_TimeModified_db, $this->two_weeks_save_array_TimeModified_db);
			}
		}

		return $this->two_weeks_save_array_TimeModified_db;
	}

//	public function calculate_totals($stand, $end) {// work in progress
//		for ($i = 0; $i < 7; $i++) {
//
//			$this->week1_total_sick_hours += $this->days[$i]->sick_hours;
//			$this->week1_total_annual_hours += $this->days[$i]->annual_hours;
//			$this->week1_total += TimeUtility::time_to_minutes($this->days[$i]->total);
//			$this->week1_total_hours_worked += TimeUtility::time_to_minutes($this->days[$i]->hours_worked);
//
//			$this->week1_total += $this->days[$i]->total;
//		}
//
//		for ($i = 7; $i < 14; $i++) {
//
//		}
//	}

	//search and get times data from specific day
	public function times_get_one_day($times_two_weeks, $datetime_iter) {
		$times_one_day = array();
		foreach ($times_two_weeks as $time) {
			if (date('Y-m-d', strtotime($time->datEvent)) == $datetime_iter) {
				array_push($times_one_day, $time);
			}
		}
		return $times_one_day;
	}

	//search and get timesheetday data from specific day
	public function get_one_day_TimesheetDay_db($two_weeks_TimesheetDay_db, $datetime_iter) {
		$one_day_TimesheetDay = array();
		foreach ($two_weeks_TimesheetDay_db as $day) {
			if (date('Y-m-d', strtotime($day->date)) == $datetime_iter) {
				$one_day_TimesheetDay = $day;
			}
		}
		return $one_day_TimesheetDay;
	}

	public function make_timesheet_data() {
		foreach ($this->days as $day) {
			$this->timesheet_data[] = $day->day_data;
		}
	}

	public function get_timesheet_data() {
		$this->make_timesheet_data();
		return $this->timesheet_data;
	}



}

?>
