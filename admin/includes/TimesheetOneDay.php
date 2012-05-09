<?php
global $db;
$GLOBALS = array('db' => &$db);

//Not DB class, had to call it that b/c TimesheetDay was already taken.
class TimesheetOneDay
{
//general
    public $timesheet_info; //obj
    public $timesheet_settings; //obj

    public $date = '';
    public $comment = '';
//raw data
    public $date_times = array();
    public $times_in_raw = array();
    public $times_out_raw = array();
    public $time_in_raw = '';
    public $time_out_raw = '';
    public $meal_times_in = array(); // the same as break
    public $meal_times_out = array();
    public $day_events_db = array();
//warnings
    public $error = array();
    public $warning = array();
    public $calculation_error = false;
//calculated based on raw data
    public $time_in = '';
    public $time_out = '';
    public $meal_period = '';
    public $meal_periods = array();
    public $hours_worked = '0:00';
    public $sick_hours = 0;
    public $annual_hours = 0;
    public $shift_hours = '0:00';
    public $total = '';
//tweaks 
    const ROUND_BY_BREAKS = 30;
    const LEGAL_HOURS_RANGE = 10;
//statistics used for error detection
    public $times_in_raw_count = 0;
    public $times_out_count = 0;
    public $times_count = 0;
//json
    public $day_data = array(); //unencoded json
    public $num = ''; //group vars by view
//db
    public $save_array_TimeModified_db = array();
    public $delete_array_TimeModified_db = array();
    public $save_TimesheetDay_db = '';
    public $delete_TimesheetDay_db = '';
    public $update_TimesheetDay_db = '';
    public $mark_empty = '';
    public $implicitly_mark_empty = false;
    public $source_db = 'TimeModified_db'; //from which db the data came from
    public $week_days = array(
        0 => 'Sun',
        1 => 'Mon',
        2 => 'Tue',
        3 => 'Wed',
        4 => 'Thu',
        5 => 'Fri',
        6 => 'Sat',
        7 => 'Sun',
        8 => 'Mon',
        9 => 'Tue',
        10 => 'Wed',
        11 => 'Thu',
        12 => 'Fri',
        13 => 'Sat'
    );

    function __construct($timesheet_info, $timesheet_settings = '')
    {
        $this->globdb = &$GLOBALS['db'];
        $this->timesheet_info = $timesheet_info;
        if (empty($timesheet_settings)) {
            $timesheet_settings = new TimesheetSettings(array());
        }
        $this->timesheet_settings = $timesheet_settings;
    }


    //this is essentially the MAIN function of this class
    public function process()
    {
        $this->ensure_day_starts_with_log_in();
        $this->calculate_statistics();
        $this->detect_error();
        $this->calculate();
        $this->make_day_data();
    }

    public function calculate()
    {
        $this->calculate_time_in_and_out();
        if ($this->timesheet_settings->overtime == false)
            $this->trim_hours();
        if ($this->timesheet_info->is_eligable_for_overtime())
            $this->calculate_shift_hours();
        $this->calculate_meal_periods();
        $this->calculate_hours_worked();
        $this->enforce_break();
        $this->calculate_total();
    }

    //convert received data to class state
    //persist_source_db inits source_db to what it was set in day_data
    //validate all = Time and TimesheetDay input.  Sometimes there is no need to validate Time
    public function process_day_data($day_data)
    {
        //persist source_db if the only thing being saved in TimesheetDay
        if ($this->timesheet_settings->persist_source_db === true) { //fixes bug with this check going through when it shouldnt due to implicit conversion
            $this->source_db = $day_data['is_modified'] == 'Yes' ? 'TimeModified_db' : 'Time_db';
        }

        $input_error = '';

        if ($this->timesheet_settings->validate) {
            $input_error = $this->input_validate($day_data);
            $day_data['input_error'] = $input_error;
        }

        if (empty($input_error)) {

            $this->comment = $this->globdb->escapeSimple(trim($day_data['comment']));
            $this->annual_hours = $this->globdb->escapeSimple($day_data['annual_hours']);
            $this->sick_hours = $this->globdb->escapeSimple($day_data['sick_hours']);

            if (!empty($day_data['time_in_raw']))
                $this->times_in_raw[] = $day_data['time_in_raw'];
            foreach ($day_data['meal_period_times_raw'] as $data) {
                if (!empty($data['meal_period_in']))
                    $this->times_out_raw[] = $data['meal_period_in'];
                if (!empty($data['meal_period_out']))
                    $this->times_in_raw[] = $data['meal_period_out'];
            }
            if (!empty($day_data['time_out_raw']))
                $this->times_out_raw[] = $day_data['time_out_raw'];

            $this->process();
        } else {
            $this->day_data = $day_data; //spit the object back with an error
        }
    }

    //prepare unencoded json to send to the client
    public function make_day_data()
    {
        $day_data = array(
            "num" => $this->num,
            "day" => $this->week_days[$this->num - 1],
            "date" => TimeUtility::date_db_to_date_view($this->date),
            "time_in" => $this->time_in,
            "meal_period" => $this->meal_period,
            "time_out" => $this->time_out,
            "time_in_raw" => $this->time_in_raw,
            "meal_period_times_raw" => array(),
            "time_out_raw" => $this->time_out_raw,
            "hours_worked" => $this->hours_worked,
            "error" => $this->error_to_html($this->error),
            "warning" => $this->error_to_html($this->warning),
            "success" => '',
            "input_error" => '',
            "sick_hours" => $this->sick_hours,
            "annual_hours" => $this->annual_hours,
            "shift_hours" => $this->shift_hours,
            "total" => $this->total,
            "comment" => $this->comment,
            "is_modified" => ($this->source_db === 'Time_db') ? 'No' : 'Yes' //by default modified
        );

        for ($j = 0; $j < count($this->meal_times_in); $j++) {
            $day_data["meal_period_times_raw"][] = array(
                "meal_period_in" => $this->meal_times_in[$j],
                "meal_period_out" => $this->meal_times_out[$j],
                "this_meal_period" => $this->meal_periods[$j]
            );
        }
        $this->day_data = $day_data;
    }

    //converts an array of string to ul of html
    public function error_to_html($error_stack)
    {
        $error_html = '';
        if (!empty($error_stack)) {
            $error_html .= '<ul>';
            foreach ($error_stack as $error) {
                $error_html .= "<li>$error</li>";
            }
            $error_html .= '</ul>';
        }
        return $error_html;
    }

    //setting variables that are needed to do most of the functionality in this application
    //this function is mostly created for actions like restoring original times where the processing should be posponed until after
    //db items are retrieved.
    //As opposed to for example save or recalculate which can start processing the input right away.
    //It is also used when calculation is not needed at all.
    public function set_state($day_data)
    {
        $this->date = TimeUtility::date_view_to_date_db($day_data['date']);
        $this->num = $day_data['num'];
        $this->day = $day_data['day'];
    }

    //process everything disregarding user input.  Get data straight from db.
    public function process_from_db()
    {
        $this->source_db = 'TimeModified_db';

        $times_one_day = array();
        $times_one_day_Time_db = Time::getTimes(array('datEvent' => $this->date, 'lngEmployeeID' => $this->timesheet_info->get_employee_id()));
        $times_one_day_TimeModified_db = TimeModified::getTimeModified(array('datEvent' => $this->date, 'lngEmployeeID' => $this->timesheet_info->get_employee_id()));
        $one_day_TimesheetDay_db = TimesheetDay::getTimesheetDays(array('date' => $this->date, 'employee_id' => $this->timesheet_info->get_employee_id()));
        $one_day_TimesheetDay = @$one_day_TimesheetDay_db[0];

        $times_one_day = $times_one_day_TimeModified_db;


        if (empty($times_one_day)) {
            $times_one_day = $times_one_day_Time_db;
            $this->source_db = 'Time_db';
        }

        if (!empty($one_day_TimesheetDay)) {
            if ($one_day_TimesheetDay->mark_empty) {
                $this->source_db = 'TimeModified_db'; //fixes bug with discarding day causing modified to show as no
                $times_one_day = array();
            }
        }

        $this->process_times($times_one_day, $one_day_TimesheetDay);
    }

    //process from times arrays for that day
    public function process_times($times_one_day = array(), $one_day_TimesheetDay = array())
    {

        if (count($times_one_day) > 0) {
            $i = 0;
            foreach ($times_one_day as $time_obj) {
                $this->day_events_db[$i] = $time_obj;
                $this->date_times[$i] = $this->day_events_db[$i]->datEvent;
                if ($this->day_events_db[$i]->blnEventType == true) {
                    $this->times_in_raw[] = TimeUtility::datetime_to_time($this->day_events_db[$i]->datEvent);
                } else if ($this->day_events_db[$i]->blnEventType == false) {
                    $this->times_out_raw[] = TimeUtility::datetime_to_time($this->day_events_db[$i]->datEvent);
                }
                $i++;
            }


            //
            //TEST//
            //            $this->times_in_raw = array(
            ////                0 => '11:00am',
            ////                1 => '3:00pm'
            ////                2 => '7:00pm'
            //            );
            //            $this->times_out_raw = array(
            //                0 => '10:00am',
            ////                1 => '6:00pm',
            ////                2 => '8:00pm'
            //            );
            //END TEST//
        }
        if (!empty($one_day_TimesheetDay)) {
            $this->comment = $one_day_TimesheetDay->comments;
            //I do this because for some reason the db doesnt save 0 as integer but saves it as null, which returns null and I need 0;
            $this->sick_hours = (!empty($one_day_TimesheetDay->sick_hours) ? $one_day_TimesheetDay->sick_hours : 0);
            $this->annual_hours = (!empty($one_day_TimesheetDay->annual_hours) ? $one_day_TimesheetDay->annual_hours : 0);
        }

        $this->process();
    }

    public function enforce_break()
    {
        if (!$this->calculation_error) {
            $factor = (int)((TimeUtility::time_to_minutes($this->hours_worked)) / 300);//how many 5h go into hours worked
            $remainder = (int)((TimeUtility::time_to_minutes($this->hours_worked)) % 300);//to check if worked exactly in multiples of 5
            if($remainder == 0 && $factor != 0) $factor = $factor - 1; //if exactly in multiples of 5 we need to take one less
            //e.g 10h only needs 30m break but 11h needs 1h break
            $meal_period_required = TimeUtility::minutes_to_time(($factor * 30));

            if((strtotime($this->meal_period) < strtotime($meal_period_required))){
                $this->meal_period = $meal_period_required;
                $this->calculate_hours_worked();
                $this->warning[] = "Enforced a $meal_period_required break";
            }
        }

    }

    public function calculate_hours_worked()
    {
        if (!$this->calculation_error) {
            $total_hours = TimeUtility::calc_time_diff($this->time_out, $this->time_in);
            $total_hours = TimeUtility::minutes_to_time($total_hours);
            $this->hours_worked = TimeUtility::calc_time_diff($total_hours, $this->meal_period);
            $this->hours_worked = TimeUtility::minutes_to_time($this->hours_worked);
        }
    }

    public function calculate_time_in_and_out()
    {

        $this->time_in_raw = $this->times_in_raw[0];
        $this->time_out_raw = end($this->times_out_raw);

        if (!$this->calculation_error) {
            $this->time_in = TimeUtility::round_time_gia($this->time_in_raw);
            $this->time_out = TimeUtility::round_time_gia($this->time_out_raw);

            if ($this->time_in == $this->time_out) {
                $this->calculation_error = true;
                $this->error[] = 'The person worked less than half an hour';
                $this->time_in = '';
                $this->time_out = '';
            }
        }
    }

    //it rounds the breaks(meal periods) only after their sum is calculated
    public function calculate_meal_periods()
    {
        for ($i = 0; $i < count($this->times_in_raw) - 1; $i++) { //not using $this->times_in_raw_count because empty breaks might be added before this point
            $this->meal_times_in[] = $this->times_out_raw[$i];
            $this->meal_times_out[] = $this->times_in_raw[$i + 1];
            $difference = TimeUtility::calc_time_diff($this->times_in_raw[$i + 1], $this->times_out_raw[$i]);
            array_push($this->meal_periods, TimeUtility::minutes_to_time($difference));

            if (!$this->calculation_error) {
                $this->meal_period += $difference;
            }
        }
        if (!$this->calculation_error) {
            $this->meal_period = TimeUtility::minutes_to_time($this->meal_period);
            $this->meal_period = TimeUtility::round_time_gi($this->meal_period, self::ROUND_BY_BREAKS);
        }
    }

    //total hours worked
    public function calculate_total()
    {
        if (!$this->calculation_error) {
            $this->total = TimeUtility::time_to_minutes($this->hours_worked) + ($this->sick_hours * 60) + ($this->annual_hours * 60);
            $this->total = TimeUtility::minutes_to_time($this->total);
        } else {
            $this->total = ($this->sick_hours * 60) + ($this->annual_hours * 60);
            $this->total = TimeUtility::minutes_to_time($this->total);
        }
    }

    public function calculate_shift_hours()
    {
        if (!$this->calculation_error) {
            $time_out = $this->time_out;
            $time_in = $this->time_in;
            $diff = 0;

            if (strtotime($time_out) > strtotime('18:00')) {
                $diff += TimeUtility::calc_time_diff($time_out, '18:00');
            }

            if (strtotime($time_in) < strtotime('8:00 am')) {
                $diff += TimeUtility::calc_time_diff('8:00 am', $time_in);
            }

            if ($diff != 0) {
                $this->warning[] = "Overtime detected";
            }

            $this->shift_hours = TimeUtility::minutes_to_time($diff);
        }
    }

    //doesnt allow overtime (shift hours) unless its coming from TimeModified (meaning it was saved)
    //shift hours is time after 6pm
    public function trim_hours()
    {
        if (!$this->calculation_error && $this->source_db == 'Time_db') {
            $time_out = $this->time_out;
            $time_in = $this->time_in;
            $cutoff = false;
            $times = array();
            $up_hours_cut = $this->timesheet_settings->up_hours_cut;
            $down_hours_cut = $this->timesheet_settings->down_hours_cut;

            if (strtotime($time_out) > strtotime("$down_hours_cut")) {
                $this->warning[] = 'Hours were cut off:';
                $this->warning[] = "Time Out was cut-off from $this->time_out_raw to $down_hours_cut.";
                $this->time_out = $down_hours_cut;
                $this->time_out_raw = $down_hours_cut;
                $this->times_out_raw[count($this->times_out_raw) - 1] = $down_hours_cut;
                $cutoff = true;
            }

            if (strtotime($time_in) < strtotime($up_hours_cut)) {
                if ($cutoff == false) {
                    $this->warning[] = 'Hours were cut off:';
                    $cutoff = true;
                }
                $this->warning[] = "Time In was cut-off from $this->time_in_raw to $up_hours_cut.";
                $this->time_in = $up_hours_cut;
                $this->time_in_raw = $up_hours_cut;
                $this->times_in_raw[0] = $up_hours_cut;
            }

            if (strtotime($this->time_in) > strtotime($this->time_out)) {
                throw new Exception("You cannot have Time In be later then Time Out in " . TimeUtility::date_db_to_date_view($this->date));
            }

            for ($i = 0; $i < count($this->times_in_raw); $i++) {
                $times[] = strtotime($this->times_in_raw[$i]);
                $times[] = strtotime($this->times_out_raw[$i]);
            }

            if (!$this->is_chronological_order($times)) {
                throw new Exception("Trim conflicts with break times in " . TimeUtility::date_db_to_date_view($this->date));
            }
        }

    }

    //****empty fields****/
    public function add_empty_log_out()
    {
        array_push($this->times_out_raw, '');
    }

    public function add_empty_break()
    {
        array_splice($this->times_in_raw, ($this->times_in_raw_count), 0, '');
        array_splice($this->times_out_raw, ($this->times_out_raw_count - 1), 0, '');
    }

    public function add_empty_log_in()
    {
        array_unshift($this->times_in_raw, '');
    }

    public function add_empty_log_in_and_log_out()
    {
        $this->add_empty_log_in();
        $this->add_empty_log_out();
    }

    public function remove_first_log_out()
    {
        array_shift($this->times_out_raw);
    }

    //**end empty fields**/

    /*	 * ****** VALIDATION AND ERRORS ********* */

    //validate received day_data from form
    public function input_validate($day_data = array())
    {
        $input_validation_error = '';
        $fields = array(); //every field
        $input_times = array(); //only times

        $sick_hours = $day_data['sick_hours'];
        $annual_hours = $day_data['annual_hours'];

        $fields[] = $day_data['time_in_raw'];
        $input_times[] = strtotime($day_data['time_in_raw']); //strtotime b/c it will be compared

        foreach ($day_data['meal_period_times_raw'] as $break) {
            $input_times[] = strtotime($break['meal_period_in']);
            $fields[] = $break['meal_period_in'];
            $input_times[] = strtotime($break['meal_period_out']);


            $fields[] = $break['meal_period_out'];
        }

        $fields[] = $day_data['time_out_raw'];
        $input_times[] = strtotime($day_data['time_out_raw']);

        if ($this->timesheet_settings->validate === 'all') { //fixes bug with this check going through when it shouldnt due to implicit conversion
            if ($this->contains_empty_field($fields)) {
                $input_validation_error .= "All of the fields must be filled out. <br />";
                return $input_validation_error;
            }
        }

        if (!$this->regex_check($fields, $sick_hours, $annual_hours)) {
            $input_validation_error .= "Invalid input detected";
            return $input_validation_error;
        }

        if ($this->timesheet_settings->validate === 'all') { //fixes bug with this check going through when it shouldnt due to implicit conversion
            if (!$this->is_chronological_order($input_times)) {
                $input_validation_error .= 'The times are not in chronological order. <br />';
            }
        }

        if (!$this->is_correct_range($sick_hours, $annual_hours)) {
            $input_validation_error .= "Sick hours and annual hours must be less than " . self::LEGAL_HOURS_RANGE;
        }


        return $input_validation_error;
    }

    public function regex_check($fields, $sick_hours, $annual_hours)
    {
        if (!preg_match('/^(([0-9]*)|([0-9]*[.][5]))$/', $sick_hours) || !preg_match('/^(([0-9]*)|([0-9]*[.][5]))$/', $annual_hours)) {
            return false;
        }

        if ($this->timesheet_settings->validate === 'all') {
            if (!$this->implicitly_mark_empty) {
                foreach ($fields as $time) {
                    if (!preg_match("/^((?:1[0-2])|(?:0?[0-9])):([0-5][0-9])(\s)(am|pm)$/", $time)) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    //checks if sick and shift hours are in a correct range
    public function is_correct_range($sick_hours, $annual_hours)
    {
        if ($sick_hours > self::LEGAL_HOURS_RANGE || $annual_hours > self::LEGAL_HOURS_RANGE) {
            return false;
        }
        else
            return true;
    }

    //makes sure the times mimic how clock-in and out works (chronological)
    public function is_chronological_order($unsorted_times = array())
    {
        $temp = $unsorted_times;
        sort($temp);
        $sorted_times = $temp;

        if ($sorted_times == $unsorted_times)
            return true;
        else
            return false;
    }

    //checks to make sure that either all of the fields are completely left blank, or all of them are filled out
    public function contains_empty_field($fields = array())
    {

        $has_empty = in_array('', $fields); //at least one empty field

        if ($has_empty) {
            foreach ($fields as $field) {
                if (!empty($field)) {
                    return true; //not all of them were empty
                }
            }

            //gets here when ALL of the times fields are empty.
            //which is not an error and means that the day has to be marked empty.
            $this->implicitly_mark_empty = true;
        }

        return false;
    }

    //used in error detection funcs
    public function calculate_statistics()
    {
        $this->times_in_raw_count = count($this->times_in_raw);
        $this->times_out_raw_count = count($this->times_out_raw);
        $this->times_count = $this->times_in_raw_count + $this->times_out_raw_count;
    }

    //It can happen if someone did not log out the day before and db was left running with time in,
    //resulting in time out being first event the next day.  Usually it immediately follows with time in, which is why
    //I do <= check.  It would only be possible to do < if the database would save seconds, which it doesnt.  So,
    //there is no real way to figure out what to delete the time in or the time out.  I assume the case outlined previously.
    //However it is also possible that what happened was the person mistakenly timed in habitually on the day he shouldnt work,
    //and then immediately timed out.  In this case, the function would delete first time out causing time in to be left running all day.
    //Which would cause a bug but there is no way to fix it.  I have to make assumptions.
    public function ensure_day_starts_with_log_in()
    {
        $first_time_in_raw = (isset($this->times_in_raw[0])) ? $this->times_in_raw[0] : '';
        $first_time_out_raw = (isset($this->times_out_raw[0])) ? $this->times_out_raw[0] : '';


        if (empty($first_time_in_raw) && !empty($first_time_out_raw)) { //If the only data is time out
            $this->warning[] = "Day starts with Log Out ($first_time_out_raw)";
            $this->warning[] = "First Log out removed";
            $this->remove_first_log_out();
        }

        if (!empty($first_time_out_raw) && !empty($first_time_in_raw)) {
            if (strtotime($first_time_out_raw) <= strtotime($first_time_in_raw)) { //if first time out is earlier then time in
                $this->warning[] = "Day starts with Log Out ($first_time_out_raw)";
                $this->warning[] = "First Log out removed";
                $this->remove_first_log_out();
            }
        }
    }

    //gets here after user input is validated and the day does not start with time out
    public function detect_error()
    {
        $first_time_in_raw = (isset($this->times_in_raw[0])) ? $this->times_in_raw[0] : '';

        if ($this->times_count == 1) {
            if (!empty($first_time_in_raw)) {
                $this->error[] = "Log out is missing";
                $this->calculation_error = true;
                $this->add_empty_log_out();
            }
        } elseif ($this->times_count == 2) {
            //			$this->warning[] = "Break is missing or forgot to log in and log out after a break";
        } elseif ($this->times_in_raw_count > $this->times_out_raw_count) { //if uneven, log out doesnt match a log in
            $this->error[] = "Log out is missing";
            $this->calculation_error = true;
            $this->add_empty_log_out();
        } elseif (empty($this->times_count)) {
            $this->warning[] = "No data was found for this day";
            $this->calculation_error = true;
            $this->add_empty_log_in_and_log_out();
        }
    }

    /*	 * * END VALIDATION ** */

    //**DB**//

    public function make_save_array_TimeModified_db()
    {
        $i = 0;
        $save_array_TimeModified = array();

        foreach ($this->times_in_raw as $time) {
            if (!empty($time)) {
                $save_array_TimeModified[$i] = array(
                    'timesheet_period_id' => $this->timesheet_info->get_timesheet_period_id(),
                    'lngEmployeeID' => $this->timesheet_info->get_employee_id(),
                    'datEvent' => TimeUtility::date_and_time_to_datetime($this->date, $time),
                    'blnEventType' => 1,
                );
                $this->save_array_TimeModified_db[$i] = new TimeModified();
                $this->save_array_TimeModified_db[$i]->setPropertyValues($save_array_TimeModified[$i]);
                $i++;
            }
        }
        foreach ($this->times_out_raw as $time) {
            if (!empty($time)) {
                $save_array_TimeModified[$i] = array(
                    'timesheet_period_id' => $this->timesheet_info->get_timesheet_period_id(),
                    'lngEmployeeID' => $this->timesheet_info->get_employee_id(),
                    'datEvent' => TimeUtility::date_and_time_to_datetime($this->date, $time),
                    'blnEventType' => 0,
                );
                $this->save_array_TimeModified_db[$i] = new TimeModified();
                $this->save_array_TimeModified_db[$i]->setPropertyValues($save_array_TimeModified[$i]);
                $i++;
            }
        }
    }

    public function make_delete_array_TimeModified_db()
    {
        $this->delete_array_TimeModified_db = TimeModified::getTimeModified(array('timesheet_period_id' => $this->timesheet_info->get_timesheet_period_id(), 'lngEmployeeID' => $this->timesheet_info->get_employee_id(), 'datEvent' => $this->date));
    }

    //The most confusing part may be implicitly mark empty.  Implicitly mark empty takes care of a case when there IS data for the day from Time db,
    //and the user deletes all of the data and fills out sick or annual hours and then clicks save.  Since the day was not explicitly marked empty,
    //on refresh the data would return to whatever was in Time db.  Setting implicitly mark empty fixes that issue.
    //Implicitly mark empty gets set at the validation of input stage.
    public function make_update_TimesheetDay_db($type = 'save')
    {
        $timesheet_day_array = TimesheetDay::getTimesheetDays(array('date' => $this->date, 'employee_id' => $this->timesheet_info->get_employee_id()));
        if (empty($timesheet_day_array)) {
            $this->update_TimesheetDay_db = new TimesheetDay();
            $this->update_TimesheetDay_db->employee_id = $this->timesheet_info->get_employee_id();
            $this->update_TimesheetDay_db->date = $this->date;
        } else {
            $this->update_TimesheetDay_db = $timesheet_day_array[0];
        }

        switch ($type) {

            case 'mark_empty':
                $this->update_TimesheetDay_db->sick_hours = 0;
                $this->update_TimesheetDay_db->annual_hours = 0;
                $this->update_TimesheetDay_db->mark_empty = true;

                break;

            case 'delete':
                $this->update_TimesheetDay_db->sick_hours = 0;
                $this->update_TimesheetDay_db->annual_hours = 0;
                $this->update_TimesheetDay_db->mark_empty = 0; //can't save false into db for some reason

                break;

            case 'save':
                $this->update_TimesheetDay_db->annual_hours = $this->annual_hours;
                $this->update_TimesheetDay_db->sick_hours = $this->sick_hours;
                $this->update_TimesheetDay_db->comments = $this->comment;
                if ($this->implicitly_mark_empty == true) {
                    $this->update_TimesheetDay_db->mark_empty = true;
                } else {
                    $this->update_TimesheetDay_db->mark_empty = 0;
                }

                break;

            case 'user_save': //when saved from employee view without admin privilages
                $this->update_TimesheetDay_db->comments = $this->comment;
                $this->update_TimesheetDay_db->annual_hours = $this->annual_hours;
                $this->update_TimesheetDay_db->sick_hours = $this->sick_hours;
                break;
        }

    }

    //**END DB**//

    //returns recalculated data based on user input for that day
   	public function get_reprocessed_day($day_data) {

   		$this->set_state($day_data);

   		if (!$this->timesheet_settings->from_db) {
   			$this->process_day_data($day_data);
   		} else {
   			$this->process_from_db($day_data);
   		}
   		$this->day_data['success'] = $this->timesheet_settings->success_message;
   		return $this->day_data;
   	}

   	public function set_day_state($day_data) {
   		$this->set_state($day_data);
   	}

   	public function get_delete_array_TimeModified_db() {
   		$this->make_delete_array_TimeModified_db();
   		return $this->delete_array_TimeModified_db;
   	}

   	public function get_save_array_TimeModified_db() {
   		$this->make_save_array_TimeModified_db();
   		return $this->save_array_TimeModified_db;
   	}

   	public function get_update_TimesheetDay_db($type) {
   		$this->make_update_TimesheetDay_db($type);
   		return $this->update_TimesheetDay_db;
   	}
}

?>