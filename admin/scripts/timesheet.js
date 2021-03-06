$(document).ready(function () {
    //Main thing to remember is that object(day_data) is cloned before being displayed in the modal.  Because of that,
    //the object is not linked to the original array of 7-14 objects representing the timesheet.
    //For that reason I tried to keep the convention of referring to data objects of modal as modal_day_data,
    //and to objects displayed on the timesheet as day_data.
    //The same applies to template objects.  For modal I refer to them as modal_day_tmpl, and for timesheet,
    //day_tmpl.

    //view-model
    var timesheet = {
        two_weeks_total:new Object(),
        week1:new Object(), //array of 14 json objects is split into sets of 7 for each week
        week2:new Object(),
        week1_total:new Object(), //week sub totals
        week2_total:new Object(),
        init:function (two_weeks) {
            this.week1 = two_weeks.slice(0, 7);
            this.week2 = two_weeks.slice(7, 14);
            this.calculate_totals();
            this.populate_timesheet();
        },
        calculate_sub_total:function (week_data, week_total) {
            var total = 0;
            var total_hours_worked = 0;
            var total_sick_hours = 0;
            var total_annual_hours = 0;
            var total_shift_hours = 0;
            for (i in week_data) {
                total += get_minutes(week_data[i].total);
                total_hours_worked += get_minutes(week_data[i].hours_worked);
                total_shift_hours += get_minutes(week_data[i].shift_hours);
                if (week_data[i].sick_hours == '')
                    week_data[i].sick_hours = 0;
                if (week_data[i].annual_hours == '')
                    week_data[i].annual_hours = 0;
                total_sick_hours += parseFloat(week_data[i].sick_hours);
                total_annual_hours += parseFloat(week_data[i].annual_hours);
            }

            total = minutes_to_time(total);
            total_hours_worked = minutes_to_time(total_hours_worked);
            total_shift_hours = minutes_to_time(total_shift_hours);


            week_total.total = total;
            week_total.total_hours_worked = total_hours_worked;
            week_total.total_sick_hours = total_sick_hours;
            week_total.total_annual_hours = total_annual_hours;
            week_total.total_shift_hours = total_shift_hours;

        },
        calculate_sub_totals:function () {
            this.calculate_sub_total(this.week1, this.week1_total);
            this.calculate_sub_total(this.week2, this.week2_total);
        },
        calculate_totals:function () {
            this.calculate_sub_totals();
            var total = 0;
            var total_hours_worked = 0;
            var total_sick_hours = 0;
            var total_annual_hours = 0;
            var total_shift_hours = 0;

            total = get_minutes(this.week1_total.total) + get_minutes(this.week2_total.total);
            total_hours_worked = get_minutes(this.week1_total.total_hours_worked) + get_minutes(this.week2_total.total_hours_worked);
            total_shift_hours = get_minutes(this.week1_total.total_shift_hours) + get_minutes(this.week2_total.total_shift_hours);
            total_sick_hours = this.week1_total.total_sick_hours + this.week2_total.total_sick_hours;
            total_annual_hours = this.week1_total.total_annual_hours + this.week2_total.total_annual_hours;

            total = minutes_to_time(total);
            total_hours_worked = minutes_to_time(total_hours_worked);
            total_shift_hours = minutes_to_time(total_shift_hours);

            this.two_weeks_total.total = total;
            this.two_weeks_total.total_hours_worked = total_hours_worked;
            this.two_weeks_total.total_sick_hours = total_sick_hours;
            this.two_weeks_total.total_annual_hours = total_annual_hours;
            this.two_weeks_total.total_shift_hours = total_shift_hours;

        },
        get_week1_total_tmpl:function () {
            return $("#week1_totals input").tmplItem();
        },
        get_week2_total_tmpl:function () {
            return $("#week2_totals input").tmplItem();
        },
        get_total_tmpl:function () {
            return $("#totals input").tmplItem();
        },
        update_totals_tmpl:function () {
            this.get_week1_total_tmpl().update();
            this.get_week2_total_tmpl().update();
            this.get_total_tmpl().update();
        },
        recaculate_totals:function () {
            this.calculate_totals();
            this.update_totals_tmpl();
        },
        get_modal_day_tmpl:function () {
            return $("#day_raw_modal_data input").tmplItem();
        },
        is_input_error:function () {
            return this.get_modal_day_tmpl().data.input_error.length ? true : false;
        },
        assign_modal_day_data_to_timesheet:function (day_tmpl) {
            var modal_day_tmpl = this.get_modal_day_tmpl();
            for (var i in modal_day_tmpl.data) { //fixes data-linking bug
                day_tmpl.data[i] = modal_day_tmpl.data[i];
            }
        },
        populate_timesheet:function () {
            $("#week1").html($("#day_calculated_template").tmpl(timesheet.week1));
            $("#week2").html($("#day_calculated_template").tmpl(timesheet.week2));
            $("#week1_totals").html($("#totals_template").tmpl(timesheet.week1_total, {
                "header":"Sub Total"
            }));
            $("#week2_totals").html($("#totals_template").tmpl(timesheet.week2_total, {
                "header":"Sub Total"
            }));
            $("#totals").html($("#totals_template").tmpl(timesheet.two_weeks_total, {
                "header":"Total"
            }));
        },
        assign_day_received_data_to_modal_day:function (day_data_received) {
            var modal_day_tmpl = this.get_modal_day_tmpl();
            modal_day_tmpl.data = day_data_received;
            modal_day_tmpl.update(); //update the view of the modal
        },
        render_modal:function (day_tmpl) {
            //the view-model for that day(json) is cloned before being rendered into modal to provide features such as cancel and detect changes.
            var day_clone = JSON.parse(JSON.stringify(day_tmpl.data));//creates a copy of the object
            $("#day_raw_modal").data('day_tmpl', day_tmpl).dialog("open");//pass the reference to the original template for updating
            $("#day_raw_modal_data").html($("#day_raw_modal_template").tmpl(day_clone));//use clone to render modal

            admin_settings();
        },
        is_changed_day_data:function (day_data) {
            return !this.is_equal_day_data(this.get_modal_day_tmpl().data, day_data);
        },
        //this data can intervene with object comparisons or display nonsensical errors/warnings.
        strip_irrelevant_data:function (day_data) {
            day_data.success = '';
            day_data.warning = '';
            day_data.error = '';
            day_data.input_error = '';
            return day_data;
        },
        //compares cloned object with the object in the modal to detect changes
        is_equal_day_data:function (day_data1, day_data2) {

            //clone objects to prevent changing the objects themselves
            day_data1 = JSON.parse(JSON.stringify(day_data1, filter));
            day_data2 = JSON.parse(JSON.stringify(day_data2, filter));

            //remove data that might throw of the comparison
            day_data1 = timesheet.strip_irrelevant_data(day_data1);
            day_data2 = timesheet.strip_irrelevant_data(day_data2);

            day_data1.is_modified = '';
            day_data2.is_modified = '';

            delete day_data1.timesheet_period_id;
            delete day_data2.timesheet_period_id;

            delete day_data1.employee_id;
            delete day_data2.employee_id;

            //compare
            if (object_equals(day_data1, day_data2)) {
                return true;
            }
            else {
                return false;
            }
        },
        calculate_breaks_diff:function (modal_day_tmpl) {

            var modal_day_data = modal_day_tmpl.data;
            if (Date.parse(modal_day_data.meal_period_in) != null && Date.parse(modal_day_data.meal_period_out) != null) {
                var time_in = Date.parse(modal_day_data.meal_period_in);
                var time_out = Date.parse(modal_day_data.meal_period_out);
                var total = time_out.add({
                    hours:-1 * time_in.getHours(),
                    minutes:-1 * time_in.getMinutes()
                });
                modal_day_data.this_meal_period = "" + total.getHours() + ":" + total.getMinutes();
                modal_day_tmpl.update();
            }
        },
        add_break:function (modal_day_tmpl) {
            modal_day_tmpl.data.meal_period_times_raw.push({
                "meal_period_in":"",
                "meal_period_out":""
            });
            modal_day_tmpl.update();
        },
        remove_break:function (modal_day_tmpl) {
            var index = $.inArray(modal_day_tmpl.data, modal_day_tmpl.parent.data.meal_period_times_raw);
            modal_day_tmpl.parent.data.meal_period_times_raw.splice(index, 1);
            modal_day_tmpl.parent.update();
        }

    }


//hide next/previous employee buttons if the user is user because there is no next/previous for them
    if (timesheet_info.is_admin != 1) {
        $('#select_timesheet_form .next_employee, #footer_interface .next_employee').hide();
        $('#select_timesheet_form .previous_employee, #footer_interface .previous_employee').hide();
        $('#cut_overtime_options').remove();
    }


//set the employee and department selectors to either get or first one by default
    $('#employee_id').val(timesheet_info.lngID);
    $('#department_id').val(timesheet_info.department_id);

    var selected_employee_id = $('#employee_id option:selected').val();

//disable next/previous employee buttons if there is no next/previous
    if (selected_employee_id == $('#employee_id option:first').val()) {
        $('#select_timesheet_form .previous_employee, #footer_interface .previous_employee').attr('disabled', 'disabled');
    }

    if (selected_employee_id == $('#employee_id option:last').val()) {
        $('#select_timesheet_form .next_employee, #footer_interface .next_employee').attr('disabled', 'disabled');
    }

//circular cycle through employees forward
    $('#select_timesheet_form .next_employee, #footer_interface .next_employee').click(function () { // used to get to next employee on the list with >>
        $('#employee_id option:selected').next('option').attr('selected', 'selected');
        $('#employee_id').change();
    });

//circular cycle through employees backwards
    $('#select_timesheet_form .previous_employee, #footer_interface .previous_employee').click(function () {
        $('#employee_id option:selected').prev('option').attr('selected', 'selected');
        $('#employee_id').change();
    });

    //next and previous timesheet periods
    $('#select_timesheet_form .next_period').click(function () {
        var dateid = $('#date');
        var date = dateid.val();
        var next_period = Date.parse(date).add({days:14}).toString('yyyy-MM-dd');
        dateid.val(next_period);
        dateid.change();
    });

    $('#select_timesheet_form .previous_period').click(function () {
        var dateid = $('#date');
        var date = dateid.val();
        var previous_period = Date.parse(date).add({days:-14}).toString('yyyy-MM-dd');
        dateid.val(previous_period);
        dateid.change();
    });

//if all of the selectors are selected show the timesheet
    if (isSelectedAll()) {
        get_timesheet(type = 'get_timesheet', controller = 'ajax_index');
    }
    else $('#timesheet').hide();

    function isSelectedAll() {
        if ($('#date').val() != '' && $('#employee_id').val() != '' && $('#department_id').val() != '') {
            return true;
        }
        else return false;
    }


//post the selectors on change
    $('#select_timesheet_form .selector').change(function () {
        if (timesheet_info.department_id != $('#department_id').val()) {
            $('#employee_id').val(null);
        }
        post();
    });

    function post() {
        $('#select_timesheet_form').trigger('submit');
    }

//get entire timesheet with ajax
    function get_timesheet(type, controller) {
        $('#timesheet').show();
        $('#week1, #week2').html($("#loading1").tmpl());
        $('#week1_totals, #week2_totals').html($("#loading2").tmpl());
//		
        var link = (controller == 'ajax_index') ? 'ajax/ajax_index.php?query=' : 'ajax_controller.php?action=';
        var json_encoded_timesheet_info = JSON.stringify(timesheet_info);
        $.ajax({
            url:link + type,
            data:{
                timesheet_info:json_encoded_timesheet_info
            },
            async:true,
            dataType:'json',
            error:function (data) {
//                console.log(data);
//                $('#error_msg').html(data).show();
                $('#error_msg').html("<p>Failed to load data.</p>").show();
                $('#timesheet').hide();
            },
            success:function (data) {
//                console.log(data);
//                $('#error_msg').html(data).show();
                if (!data.error) {
                    var two_weeks = (controller == 'ajax_index') ? data : data.message;
                    timesheet.init(two_weeks);
                    //console.log(two_weeks);
                    $('#error_msg').hide();
                } else {
                    timesheet.populate_timesheet();//use old data
                    $('#error_msg').html(data.error).show();
                    $('html, body').animate({
                        scrollTop:0
                    }, 'fast');
                }
            }
        });

    }

//get one day with ajax.  Type argument signifies action.
    function get_day(type, day_tmpl, controller, auto_close) {

        var link = (controller == 'ajax_index') ? 'ajax/ajax_index.php?query=' : 'ajax_controller.php?action=';

        var modal_day_data = timesheet.get_modal_day_tmpl().data;
        modal_day_data = timesheet.strip_irrelevant_data(modal_day_data);

        var json_encoded_day_data = JSON.stringify(modal_day_data);
        var json_encoded_timesheet_info = JSON.stringify(timesheet_info);

        $.ajax({
            url:link + type,
            data:{
                json:json_encoded_day_data,
                timesheet_info:json_encoded_timesheet_info
            },
            async:false,
            dataType:'json', //replace with 'text' to debug and 'json' to make it work.
            error:function () {
//                $('#error_msg').html(data).show();
                $('#day_raw_modal').dialog('close');
                $('#error_msg').html("<p>Failed to load data.</p>").show();
                $('#timesheet').hide();
            },
            success:function (data) {
//                $('#error_msg').html("<p>" +  data + "</p>").show();
//                $('#error_msg').html(data).show();
                var day_data_received = (controller == 'ajax_index') ? data : data.message;
                timesheet.assign_day_received_data_to_modal_day(day_data_received);
                if (!timesheet.is_input_error()) { //if no input error, update the timesheet data
                    timesheet.assign_modal_day_data_to_timesheet(day_tmpl); //copy the data from modal to non-modal (timesheet)
                    day_tmpl.data.success = ''; //earase the success message so its not there on next open triger
                    timesheet.recaculate_totals();
                    day_tmpl.update(); //update the view of the non modal timesheet
                    if (auto_close) $('#day_raw_modal').dialog('close');
                }
                admin_settings();
            }
        });
    }

//day calculated are the links on the page that trigger modal
    $('#timesheet .day_grid').delegate('.day_calculated', 'click', function () {
        var day_tmpl = $(this).tmplItem();
        timesheet.render_modal(day_tmpl);
    });

    $("#trim_hours_modal").dialog({
        autoOpen:false,
        modal:true,
        position:'center',
        width:350,
        resizable:false,
        closeOnEscape:false,
        draggable:false,
        close:function () {
            $('div.time-picker').hide();
        }, //prevents time picker remaining open bug
        open:function () {
            $('#trim_hours_modal input').blur();
        }
    });

    $("#day_raw_modal").dialog({
        autoOpen:false,
        width:800,
        height:600,
        modal:true,
        resizable:false,
        position:'center',
        draggable:false,
        closeOnEscape:false,
        open:function (event, ui) {
            $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
        }, //hide X(close)
        close:function () {
            $('div.time-picker').hide();
        },
        buttons:(function () {
            var arrows = {
                "<<<":function () {
                    var day_tmpl = $(this).data('day_tmpl');
                    var answer = true;

                    if (timesheet.is_changed_day_data(day_tmpl.data)) {
                        answer = confirm("Are you sure you want to discard the changes?");
                    }

                    if (answer) {
                        var start_date_limit = Date.parse(timesheet_info.start_date);
                        start_date_limit = start_date_limit.add({
                            days:-1
                        });
                        start_date_limit = start_date_limit.toString('MM/dd/yyyy');


                        var this_date = Date.parse(day_tmpl.data.date);
                        var previous_date = this_date.add({
                            days:-1
                        });
                        previous_date = previous_date.toString('MM/dd/yyyy');
                        if (previous_date === start_date_limit) { //go in circle or disable
                            alert("This is the first day in this pay period");
                            $(this).button('disable');
                        }
                        //find the previous date in the non-modal and use its linked template to render modal
                        day_tmpl = $("a:contains('" + previous_date + "')").tmplItem();
                        timesheet.render_modal(day_tmpl);
                    }
                },
                ">>>":function () {
                    var day_tmpl = $(this).data('day_tmpl');
                    var answer = true;

                    if (timesheet.is_changed_day_data(day_tmpl.data)) {
                        answer = confirm("Are you sure you want to discard the changes?");
                    }

                    if (answer) {
                        var end_date_limit = Date.parse(timesheet_info.end_date);
                        end_date_limit = end_date_limit.add({
                            days:1
                        });
                        end_date_limit = end_date_limit.toString('MM/dd/yyyy');

                        var this_date = Date.parse(day_tmpl.data.date);
                        var next_date = this_date.add({
                            days:1
                        });
                        next_date = next_date.toString('MM/dd/yyyy');
                        if (next_date === end_date_limit) {
                            alert("You reached the last day in this pay period");
                            $(this).button('disable');
                        }
                        day_tmpl = $("a:contains('" + next_date + "')").tmplItem();
                        timesheet.render_modal(day_tmpl);
                    }
                }
            }
            var admin_buttons = {
                "Restore Original Times":function () {
                    var day_tmpl = $(this).data('day_tmpl');
                    var answer = confirm("You are about to discard the user-modified times and restore the originals. Continue?");

                    if (answer) {
                        get_day('restore_day', day_tmpl, 'ajax_controller', false);
                    }
                },
                "Discard Day":function () {
                    var day_tmpl = $(this).data('day_tmpl');
                    var answer = confirm("You are about to discard all of the employee data for this day. Continue?");

                    if (answer) {
                        get_day('discard_day', day_tmpl, 'ajax_controller', true);
                    }
                }
            }
            var user_buttons = {
                "Save":function () {
                    var day_tmpl = $(this).data('day_tmpl');//reference to the original object (before cloning) needed to update the non-modal view
                    var answer = true;
                    if (answer) {
                        var type = timesheet_info.is_admin ? "save_day" : "update_comment_day";
//                        console.log(type);
                        get_day(type, day_tmpl, 'ajax_controller', true); //get the new object and update the non-modal view
                    }
                },
                "Close":function () {
                    var day_tmpl = $(this).data('day_tmpl');
                    var answer = true;

                    if (timesheet.is_changed_day_data(day_tmpl.data)) { //detect changes
                        answer = confirm("Are you sure you want to discard the changes?");
                    }

                    if (answer) {
                        $(this).dialog("close");
                    }
                }
            }

            var buttons = timesheet_info.is_admin ? $.extend(admin_buttons, user_buttons) : user_buttons;
            buttons = $.extend(arrows, buttons);
            return buttons;
        })()
    });


    function admin_settings() {
        if (timesheet_info.is_admin != 1) {
            $('#day_raw_modal .day_raw_grid input').attr('disabled', true);
            $('#day_raw_modal button, #cut_overtime_options').attr('disabled', true);
        }
    }


//delegate makes sure trigger is not removed as button comes in and out of existence in the dom
//removes break in and out of a certain index depending on where the button was clicked
//simply adds break in and out to the data and rerenders the template
    $('#day_raw_modal')
        .delegate('button.add_break', 'click', function () {
            var modal_day_tmpl = $(this).tmplItem();
            timesheet.add_break(modal_day_tmpl);
        })
        //it works because each corresponding input fields has the same name as the variable name in the json(view-model)
        .delegate("input, textarea", "change", function () {
            /* Set the data to the modified value */
            $.tmplItem(this).data[ this.name ] = this.value;
        })
        //calculates total for each break
        .delegate("input.break", "change", function () {
            var modal_day_tmpl = $.tmplItem(this);
            timesheet.calculate_breaks_diff(modal_day_tmpl);
        })
        .delegate('button.remove_break', 'click', function () {
            var modal_day_tmpl = $(this).tmplItem();
            timesheet.remove_break(modal_day_tmpl);
        });

//when there, add timepicker to the input field of class time_picker
    $("#day_raw_modal, #trim_hours_modal")
        .delegate('input.time_picker, #cut_overtime_options input', 'hover', function () {
            $(this).timePicker({
                startTime:"12:00 AM", // Using string. Can take string or Date object.
                endTime:"11:30 PM",
                show24Hours:false,
                separator:':',
                step:30
            });

        })
        //one way to fix the timepicker bug
        .delegate('input.time_picker,  #cut_overtime_options input', 'focus', function () {
            $('div.time-picker').hide();
        });

//continiuation of the fix
    $('body').click(function () {
        var mouse_is_inside = false;

        $('div.time-picker').hover(function () {
            mouse_is_inside = true;
        }, function () {
            mouse_is_inside = false;
        });

        if (!mouse_is_inside) $('div.time-picker').hide();
    });

    function get_minutes(timestring) {
        var split_array = timestring.split(':');
        var hours = split_array[0];
        var minutes = hours * 60 + parseInt(split_array[1]);
        return minutes;
    }

    function minutes_to_time(total_minutes) {
        var minutes = total_minutes % 60;
        var hours = Math.floor(total_minutes / 60);
        if (minutes == 0) {
            minutes = '00';
        }
        return hours + ":" + minutes;
    }

//general object comparision function
    function object_equals(v1, v2) {

        if (typeof(v1) !== typeof(v2)) {
            return false;
        }

        if (typeof(v1) === "function") {
            return v1.toString() === v2.toString();
        }

        if (v1 instanceof Object && v2 instanceof Object) {
            if (count_props(v1) !== count_props(v2)) {
                return false;
            }
            var r = true;
            for (k in v1) {
                r = object_equals(v1[k], v2[k]);
                if (!r) {
                    return false;
                }
            }
            return true;
        } else {
            return v1 === v2;
        }
    }

//used inside object_euqals
    function count_props(obj) {
        var count = 0;
        for (k in obj) {
            if (obj.hasOwnProperty(k)) {
                count++;
            }
        }
        return count;
    }


//this function is passed to JSON.stringify() to convert ints to strings
//to avoid obj comparison bugs where one obj would have int and another string
//of the same value
    function filter(key, value) {
        if (typeof(value) == "number") {
            return value + '';
        }
        return value;
    }

    $('#trim_hours_options').click(function () {
        $('#trim_hours_modal').dialog('open');
    });

    $('#trim_hours_btn').click(function () {
        var up_hours_cut = $('#up_hours_cut').val();
        var down_hours_cut = $('#down_hours_cut').val();
        get_timesheet(type = "trim_hours_timesheet&up_hours_cut=" + up_hours_cut + "&down_hours_cut=" + down_hours_cut, controller = 'ajax_controller');
        $('#trim_hours_modal').dialog('close');
    });

//fill out form with data needed to fill out the pdf and submit it to the download page
    $('#download').click(function () {
        $('#week_data1').val(JSON.stringify(timesheet.week1));
        $('#week_data2').val(JSON.stringify(timesheet.week2));
        $('#week_total1').val(JSON.stringify(timesheet.week1_total));
        $('#week_total2').val(JSON.stringify(timesheet.week2_total));
        $('#two_week_total').val(JSON.stringify(timesheet.two_weeks_total));
        $('#first_name_data').val(timesheet_info.first_name);
        $('#last_name_data').val(timesheet_info.last_name);
        $('#ca_or_sa_data').val(timesheet_info.ca_or_sa);
        $('#payroll_period_data').val(timesheet_info.payroll_period);
        $('#department_data').val(timesheet_info.department);
        $('#pdf_form').submit();
    });
});