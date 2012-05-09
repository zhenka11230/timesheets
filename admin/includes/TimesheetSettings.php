<?php

class TimesheetSettings
{
    public $overtime; // should hours be trimmed?
    public $up_hours_cut; //trim time in to this
    public $down_hours_cut; //trim time out to this
    public $validate; // what kind of validation mode (all, false, only_TimesheetDay)
    public $persist_source_db; // should 'Modified' field be taken from client data or figured out from db
    public $from_db; //process from inputed data or get from db
    public $success_message; //what should success message be on completion

    function __construct($args = array()){

        $this->overtime = isset($args['overtime']) ? $args['overtime'] : true;
        $this->up_hours_cut = isset($args['up_hours_cut']) ? $args['up_hours_cut'] : '8:00';
        $this->down_hours_cut = isset($args['down_hours_cut']) ? $args['down_hours_cut'] : '18:00';
        $this->validate = isset($args['validate']) ? $args['validate'] : 'all';
        $this->persist_source_db = isset($args['persist_source_db']) ? $args['persist_source_db'] : false;
        $this->from_db = isset($args['from_db']) ? $args['from_db'] : false;
        $this->success_message = isset($args['success_message']) ? $args['success_message'] : "Message was not set.";
    }

}
