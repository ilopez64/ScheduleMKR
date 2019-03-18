<?php

  class Event {
    public $event_no;
    public $name;
    public $start;
    public $end;
    public $days = array();
    public $details;

    public function __construct($event_no, $name, $start, $end, $days, $details) {
      $this->event_no = $event_no;
      $this->name = $name;
      $this->start = $start;
      $this->end = $end;
      $this->days = dateToArray($days);
      $this->details = $details;
    }
  }

  function dateToArray($date) {
    substr($date, 0, -1);
    return explode(",",$date);
  }

 ?>
