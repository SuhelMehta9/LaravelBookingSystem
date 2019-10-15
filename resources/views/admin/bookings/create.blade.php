<?php
use App\Booking;
use App\Location;
use App\WorkingHour;
?>
@extends('layouts.admin')

<link href="{{ url('css/appointment-picker.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ url('js/appointment-picker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/classlist/1.2.20171210/classList.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bookings.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('select_location_id') ? 'has-error' : '' }}">
                <label for="select_location">{{ trans('cruds.booking.fields.select_location') }}*</label>
                <select name="select_location_id" id="select_location" class="form-control " required onchange="enableStartDate()"> //select2
                    @foreach($select_locations as $id => $select_location)
                        <option value="{{ $id }}" {{ (isset($booking) && $booking->select_location ? $booking->select_location->id : old('select_location_id')) == $id ? 'selected' : '' }}>{{ $select_location }}</option>
                    @endforeach
                </select>
                @if($errors->has('select_location_id'))
                    <p class="help-block">
                        {{ $errors->first('select_location_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                <label for="start_date">{{ trans('cruds.booking.fields.start_date') }}*</label>
                <input type="text" id="start_date" name="start_date" class="form-control date" value="{{ old('start_date', isset($booking) ? $booking->start_date : '') }}" required disabled onclick="enableStartTime()">
                @if($errors->has('start_date'))
                    <p class="help-block">
                        {{ $errors->first('start_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.start_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.booking.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control" value="{{ old('start_time', isset($booking) ? $booking->start_time : '') }}" required disabled onclick="startTimeClicked()">
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                <label for="end_date">{{ trans('cruds.booking.fields.end_date') }}*</label>
                <input type="text" id="end_date" name="end_date" class="form-control date" value="{{ old('end_date', isset($booking) ? $booking->end_date : '') }}" required disabled onclick="enableEndTime()">
                @if($errors->has('end_date'))
                    <p class="help-block">
                        {{ $errors->first('end_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.end_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.booking.fields.end_time') }}*</label>
                <input type="text" id="end_time" name="end_time" class="form-control" value="{{ old('end_time', isset($booking) ? $booking->end_time : '') }}" required disabled onclick="endTimeClicked()">
                @if($errors->has('end_time'))
                    <p class="help-block">
                        {{ $errors->first('end_time') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.end_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.booking.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($booking) ? $booking->name : '') }}" required disabled onclick="nameClicked()">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.booking.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($booking) ? $booking->email : '') }}" required disabled>
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                <label for="phone_number">{{ trans('cruds.booking.fields.phone_number') }}*</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($booking) ? $booking->phone_number : '') }}" required disabled>
                @if($errors->has('phone_number'))
                    <p class="help-block">
                        {{ $errors->first('phone_number') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.phone_number_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.booking.fields.description') }}*</label>
                <textarea id="description" name="description" class="form-control " required disabled>{{ old('description', isset($booking) ? $booking->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.description_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

    <?php
$locations = Location::all();
$bookings = Booking::all();
$workingHours = WorkingHour::all();
//$array = [];
$location_count = 0;
//foreach($bookings as $key => $value)
//{
//	array_push($array, $value -> select_location_id);
//}
/*foreach($array as $key){
echo $key;}*/
echo "<br>" ;
foreach($locations as $location)
{
	$i = $location -> id; 
	${"startDateOfLocation_id$i"} = [[]];
	${"endDateOfLocation_id$i"} = [[]];
	${"workingHoursOfLocation_id$i"} = [];
	//${"endDateTimestartDateOfLocation_id$i"}=[];
	$location_count += 1;
}
/*
for($i = 1; $i <= $location_count; $i++) {
	echo ${"startDateOfLocation_id$i"};
}*/
foreach($bookings as $key => $value){
	$i = $value -> select_location_id;
	//echo $i;
	echo "<br>";
	$startDateKey = $value -> start_date;
	$endDateKey = $value -> end_date;
	//echo $startDateKey;
	//echo $endDateKey;
	//$startDate = date('Y-m-d', strtotime($newKey));
	${"startDateOfLocation_id$i"}["$startDateKey"][] = [$value->start_time, $value->end_date, $value->end_time];
	${"endDateOfLocation_id$i"}["$endDateKey"][] = [$value->end_time, $value->start_date, $value->start_time];
	//${"startDateOfLocation_id$i"}["$newKey"][][] = $value->start_time;
	//${"startDateOfLocation_id$i"}["$newKey"][][] = $value->end_date;
	//${"startDateOfLocation_id$i"}["$newKey"][][] = $value->end_time;
}
echo "<br>";

foreach($workingHours as $key => $value)
{
	$i = $value -> workinghours_id;
	${"workingHoursOfLocation_id$i"} = [$value -> startworkinghour, $value -> endworkinghour];
}
//echo '<pre>' . print_r($workingHoursOfLocation_id3,1) . '</pre>';
//echo '<pre>' . print_r($endDateOfLocation_id1,1) . '</pre>';

for($i = 1; $i <= $location_count; $i++) {
/*	foreach(${"startDateOfLocation_id$i"} as $key => $value)
	{
		echo $key; echo "<br>";
		echo $value;echo "<br>";

	}*/
	?>


    <script>
        this["startDateOfLocation_id" + <?=$i?> ] = <?php echo json_encode($ {
            "startDateOfLocation_id$i"
        }) ?> ;
        this["endDateOfLocation_id" + <?=$i?> ] = <?php echo json_encode($ {
            "endDateOfLocation_id$i"
		}) ?> ;
        this["workingHoursOfLocation_id" + <?=$i?> ] = <?php echo json_encode($ {
            "workingHoursOfLocation_id$i"
		}) ?> ;
        /*$.each(startDateOfLocation_id<?=$i?>, function(key, value) {
        	console.log('stuff : ' + key + ", " + value);});*/

    </script>
    <?php	
}
//echo "<br>";*/
?>


</p>
<script type="text/javascript">
disabledTime = [];
	String.prototype.replaceAt=function(index, replacement) {
		return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
	}
function getDisabledInterval(startTime, endTime){
		disabledTime.push(startTime);
		start_time_num = parseInt(startTime.replace(/:/g, ""), 10);
		end_time_num = parseInt(endTime.replace(/:/g, ""), 10);
		intervals_count = Math.ceil((end_time_num - start_time_num) / 5000);
		for (i = 0; i<intervals_count; i++) {
			x = (start_time_num + 3000) % 10000;
			if (x >= 6000) {
				start_time_num = start_time_num + 10000 - 3000;
			}
			else {
				start_time_num = start_time_num + 3000;
			}
			//console.log(start_time_num + 3000 * (i + 1));
			start_time_str = start_time_num.toString();
			prefix_zeros = "";
			for(j = 0; j < 6 - start_time_str.length; j++) {
				prefix_zeros += "0";
			}
			start_time_str = prefix_zeros + start_time_str;
			disabledTime.push(start_time_str.substr(0, 2) + ":" + start_time_str.substr(2, 2) + ":" + start_time_str.substr(4, 2));
		}
		console.log(startTime, endTime);
		console.log("disabledTime " + disabledTime);
		disabledTime.pop();
		return disabledTime;
		disabledTime.push(startTime);
		startTime = startTime.replace(/:/g,"");
		endTime = endTime.replace(/:/g,"");
		while(true){
			if(startTime==endTime){
				break;
			}
			else if(startTime.charAt(2)==0)
			{
				//startTime.replace(startTime.charAt(2),"3");
				startTime = startTime.replaceAt(2,"3");
				console.log(startTime);
			}
			else {
				num = parseInt(startTime.charAt(1), 10);
				num += 1;
				num = num.toString();
				startTime = startTime.replaceAt(1,num);
				startTime = startTime.replaceAt(2,"0");
				console.log(startTime)
			}
		}
		console.log("WIP "+startTime+" "+endTime);
		/*if(startTime.charAt(2)==0){
				startTime = startTime.replaceAt(2,"3");
				console.log("Replaced "+startTime);
	}*/
		return disabledTime;
	}
    //var disabledTime = [];
    /*
    var startDateOfLocation_id1 = <?php echo json_encode($startDateOfLocation_id1)?>;

    			$.each(startDateOfLocation_id1, function(key, value) {
    				if(key != 0){
    					for(var i = 0; i<value.length; i++ ){
    					console.log(value);
    				disabledTime.push(String(value[i]));
    					}
    				}});

    var picker2 =*/
    /*function picker1(disabledTime){
    }*/

    /*var picker3 = new AppointmentPicker(document.getElementById('end_time'), {
    	title: 'End time',
    	leadingZero: true,
    	interval: 30,
    	large: true,
    	timeFormat24: 'H:M:00',
    });*/

    /*
    		// To use appointmentPicker as jQuery plugin
    		$.fn.appointmentPicker = function(options) {
    		    this.appointmentPicker = new AppointmentPicker(this[0], options);
    		    return this;
    		};

    	//	var x = $("#start_date").find("input").val();
    		var $picker = $('#start_time').appointmentPicker({
    		leadingZero: true, 
    		interval: 30,
    		large: true,
    		timeFormat24: 'H:M:00',
    		});



    		document.getElementById('start_time').addEventListener('click', function() {
    				var x = document.getElementById("start_date").value;
    document.getElementById("demo").innerHTML = "You selected: " + x;
    document.getElementById("end_date").removeAttribute("disabled", false);
    			});




    		var $picker = $('#end_time').appointmentPicker({
    		leadingZero: true,
    		large: true,
    		interval: 30,
    		timeFormat24: 'H:M:00',
    		disabled: ['06:00', '14:00']
    		});
     */
    //setInterval(function() { ObserveInputValue($('#start_date').val()); }, 100);


    function enableStartDate() {
        var location_id_selected = document.getElementById("select_location").value;
        //this["startDateOfLocation_id"+location_id_selected] = <?php echo json_encode($startDateOfLocation_id1)?>;
        //	alert("location_id"+location_id_selected);
        //get every booking of selected location
        //array1 = location_id+location_id_selected;
        //alert(array1);
        //this[array1] = "location_id"+location_id;


        //document.getElementById("demo").innerHTML = "Disabled time is " + disabledTime;
        //console.log(window["location_id"+location_id_selected]);
        document.getElementById("start_date").removeAttribute("disabled", false);
        var input = document.getElementById("start_date");
        input.value = "";

        //  StartTime = 15:00:00;
        //alert(typeof StartTime);
        // disabledIntervals = [];

        //picker2.disabled = disabledTime;
        //picker1(disabledTime);

    }

    //var x = $("#start_date").data("datetimepicker").getDate();
    function enableStartTime() { //when user will click on start date
        //document.getElementById("demo").innerHTML = "You selected: " + x;
        // alert($("#start_date").find("input").val());

        // reset input value if date is selected again
        document.getElementById("start_time").removeAttribute("disabled", false);
        var input = document.getElementById("start_time");
        input.value = "";
    }

    function startTimeClicked() {
		disabledTime = [];
        var current_date = document.getElementById("start_date").value;
        //document.getElementById("demo").innerHTML = "You selected: " + current_date;
        //document.getElementById("demo").innerHTML = "You selected: " + current_date.replace(/-/g, "");

		// Destroy Picker
        var location_id_selected = document.getElementById("select_location").value;
        for (i = 1; i <= <?=$location_count ?> ; i++) {
            if (typeof this["picker" + i] != 'undefined') {
                this["picker" + i].destroy();
                //alert("Destroyed");
            }
        }

		// Set end date to current date
		end_date = current_date;

		start_date_data = window["startDateOfLocation_id" + location_id_selected][current_date];
		end_date_data = window["endDateOfLocation_id" + location_id_selected][current_date];
		console.log(start_date_data);
		console.log(end_date_data);

			var i = 0;
			var counter = 0;
		if (typeof start_date_data != "undefined") {
			// Booking available on this day
			if (typeof end_date_data == "undefined") {
				// Booking ends on next date
				// for booking in which there exists no end_date_data for start_date_data corresponding 
				start_time = start_date_data[0][0];
				console.log("Hello " + start_time);
				end_time = "24:00:00";
				disabledTime = getDisabledInterval(start_time, end_time);
			}
			//else code here
			else
			{
				$.each(start_date_data, function(key, value){
					console.log(start_date_data);
					if(start_date_data[counter][1]==current_date){
						start_time = start_date_data[counter][0];
						end_time = start_date_data[counter][2];
						disabledTime = getDisabledInterval(start_time, end_time);
					}
					else if(start_date_data[counter][1]!=current_date)
					{
						start_time = start_date_data[counter][0];
						console.log("Hello " + start_time);
						end_time = "24:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
					}
				counter += 1;
			});
			/*	$.each(start_date_data, function(key, value) {
				//$.each(window["startDateOfLocation_id" + location_id_selected], function(key, value) {
					//console.log('stuff : ' + key + ", " + value);
					if (key == 0) {
					//	disabledTime.push(value);

					    for (var i = 0; i < value.length; i++) {

							//console.log(value);
							//StartTime = value;
							disabledTime.push(String(value[i]));
							console.log(value[i]);
						}
						//console.log('value : ' + value);
					}

	});*/

		}
		}

			//code to check 
			// In this code if start date is end date for some booking then tiime will be disabled from starting
				$.each(end_date_data, function(key, value){
					console.log("Out "+ end_date_data);
					if(end_date_data[i][1]!=current_date){
						end_time = end_date_data[i][0];
						start_time = "00:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
					}
					/*else if(end_date_data[i][1]==current_date)
					{
						end_time = end_date_data[i][0];
						console.log("Hello " + start_time);
						start_time = "00:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
				}*/
				i += 1;
			});
		// No need to disable anything
        if (typeof start_date_data == 'undefined') {
            console.log("No booking starting date: " + current_date);
        }
        //console.log("Hello " + start_date_data);

		//console.log("disabledTime " + disabledTime);

		start_time_of_location = window["workingHoursOfLocation_id" + location_id_selected][0];
		start_time_of_location = start_time_of_location.substr(0,2);
		end_time_of_location = window["workingHoursOfLocation_id" + location_id_selected][1];
		end_time_of_location = end_time_of_location.substr(0,2);
		console.log("Min and Start time"+start_time_of_location);
        document.getElementById("end_date").removeAttribute("disabled", false);
        var input = document.getElementById("end_date");
        input.value = "";
        this["picker" + location_id_selected] = new AppointmentPicker(document.getElementById('start_time'), {
            title: location_id_selected,
            interval: 30,
            leadingZero: true,
            large: true,
            timeFormat24: 'H:M:00',
			disabled: disabledTime,
			minTime: start_time_of_location,
			maxTime: end_time_of_location,
			startTime: start_time_of_location,
			endTime: end_time_of_location,
        });

		this["picker" + location_id_selected].open();
		
    }

    /*
    $(document).ready(function(){
        $("#start_date").on("change", function(){
            // Print entered value in a div box
    	    $("#demo").text($(this).val());
          $("#start_time").prop('disabled', false);
          
        });
    });
     */
    function enableEndTime() {
        //	var x = picker2.getTime();
        //	document.getElementById("demo").innerHTML = "You selected: " + x;

        document.getElementById("end_time").removeAttribute("disabled", false);
        var input = document.getElementById("end_time");
        input.value = "";

    }

   /* document.getElementById('end_date').addEventListener('click', function() {

        document.getElementById('demo').innerHTML = JSON.stringify(time);
        document.getElementById("start_time").removeAttribute("disabled", false);

	});*/


  function endTimeClicked() {
		var current_date = document.getElementById("end_date").value;
		var location_id_selected = document.getElementById("select_location").value;

		disabledTime = [];
		//Destroy Picker
        for (i = 1; i <= <?=$location_count ?> ; i++) {
            if (typeof this["endTimePicker" + i] !== 'undefined') {
                this["endTimePicker" + i].destroy();
                //alert("Destroyed");
            }
        }

		//code to disable end time
		end_date = current_date;

		start_date_data = window["startDateOfLocation_id" + location_id_selected][current_date];
		end_date_data = window["endDateOfLocation_id" + location_id_selected][current_date];
		console.log(start_date_data);
		console.log(end_date_data);

		selected_start_date = document.getElementById("start_date").value;
		//selected_start_date = selected_start_date.replace(/-/g, "");
		i=0;
		$.each(window["startDateOfLocation_id"+location_id_selected], function(key, value) {
   			if(key != 0){
   				for(var i = 0; i<value.length; i++ ){
					console.log("startdate "+selected_start_date);
					start_date_to_compare = key;
					//start_date_to_compare = start_date_to_compare.replace(/-/g, "");
					if(selected_start_date > start_date_to_compare && current_date < value[i][1]){
						alert("Already booked for time interval "+ key + " " + value[i][1]);
						var input_to_reset = document.getElementById("end_date");
						input_to_reset.value = "";
						input_to_reset = document.getElementById("start_date");
						input_to_reset.value = "";
					}
					else if(selected_start_date < start_date_to_compare && current_date > value[i][1])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
						var input_to_reset = document.getElementById("end_date");
						input_to_reset.value = "";
						input_to_reset = document.getElementById("start_date");
						input_to_reset.value = "";
					}
					else if(selected_start_date > start_date_to_compare && selected_start_date < value[i][1])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
                        var input_to_reset = document.getElementById("end_date");
                        input_to_reset.value = "";
                        input_to_reset = document.getElementById("start_date");
                        input_to_reset.value = "";
					}
					else if(current_date > start_date_to_compare && current_date < value[i][1])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
                        var input_to_reset = document.getElementById("end_date");
                        input_to_reset.value = "";
                        input_to_reset = document.getElementById("start_date");
                        input_to_reset.value = "";
					}
   				}
			}
		});
		var counter = 0;
		if (typeof start_date_data != "undefined") {
			// Booking available on this day
			if (typeof end_date_data == "undefined") {
				// Booking ends on next date
				// for booking in which there exists no end_date_data for start_date_data corresponding 
				start_time = start_date_data[0][0];
				console.log("Hello " + start_time);
				end_time = "24:00:00";
				disabledTime = getDisabledInterval(start_time, end_time);
			}
			//else code here
			else
			{
				$.each(start_date_data, function(key, value){
					console.log(start_date_data);
					if(start_date_data[counter][1]==current_date){
						start_time = start_date_data[counter][0];
						end_time = start_date_data[counter][2];
						disabledTime = getDisabledInterval(start_time, end_time);
					}
					else if(start_date_data[counter][1]!=current_date)
					{
						start_time = start_date_data[counter][0];
						console.log("Hello " + start_time);
						end_time = "24:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
					}
				counter += 1;
			});
		}
		}
				var i = 0;
				$.each(end_date_data, function(key, value){
					console.log("Out "+ end_date_data);
					if(end_date_data[i][1]!=current_date){
						end_time = end_date_data[i][0];
						start_time = "00:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
					}
				/*	else if(end_date_data[i][1]==current_date)
					{
						end_time = end_date_data[i][0];
						console.log("Hello " + start_time);
						start_time = "00:00:00";
						disabledTime = getDisabledInterval(start_time, end_time);
				}*/
				i += 1;
  });

		start_time_of_location = window["workingHoursOfLocation_id" + location_id_selected][0];
		start_time_of_location = start_time_of_location.substr(0,2);
		end_time_of_location = window["workingHoursOfLocation_id" + location_id_selected][1];
		end_time_of_location = end_time_of_location.substr(0,2);
		//end of that code
        this["endTimePicker" + location_id_selected] = new AppointmentPicker(document.getElementById('end_time'), {
            title: location_id_selected,
            interval: 30,
            leadingZero: true,
            large: true,
            timeFormat24: 'H:M:00',
            disabled: disabledTime,
			minTime: start_time_of_location,
			maxTime: end_time_of_location,
			startTime: start_time_of_location,
			endTime: end_time_of_location,
        });

		this["endTimePicker" + location_id_selected].open();

        document.getElementById("name").removeAttribute("disabled", false);
        document.getElementById("email").removeAttribute("disabled", false);
        document.getElementById("phone_number").removeAttribute("disabled", false);
        document.getElementById("description").removeAttribute("disabled", false);
        //document.getElementById("demo").innerHTML = "You selected: " + x;
       // document.getElementById("end_time").removeAttribute("disabled", false);
    }

	function nameClicked(){
		console.clear();
		console.log(disabledTime);

		var selected_end_date = document.getElementById("end_date").value;
		var selected_start_date = document.getElementById("start_date").value;
		var selected_start_time = document.getElementById("start_time").value;
		var selected_end_time = document.getElementById("end_time").value;
		var location_id_selected = document.getElementById("select_location").value;
		$.each(window["startDateOfLocation_id"+location_id_selected], function(key, value) {
   			if(key != 0){
   				for(var i = 0; i<value.length; i++ ){
					console.log("startdate "+selected_start_date);
					//start_date_to_compare = key;
					//start_date_to_compare = start_date_to_compare.replace(/-/g, "");
					if(selected_start_date == key && selected_end_date == value[i][1] && key == value[i][1] && selected_start_time < value[i][0] && selected_end_time > disabledTime[disabledTime.length - 1]){
						alert("Already booked for time interval "+ value[i][0] + " " + disabledTime[disabledTime.length - 1]);
						var input_to_reset = document.getElementById("end_time");
						input_to_reset.value = "";
						input_to_reset = document.getElementById("start_time");
						input_to_reset.value = "";
					}
					else if(selected_start_date == key && selected_end_date == value[i][1] && key != value[i][1] && selected_start_time < value[i][0] && selected_end_time >= value[i][2])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
						var input_to_reset = document.getElementById("end_date");
						input_to_reset.value = "";
						input_to_reset = document.getElementById("start_date");
						input_to_reset.value = "";
					}
				/*	else if(selected_start_date > start_date_to_compare && selected_start_date < value[i][1])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
                        var input_to_reset = document.getElementById("end_date");
                        input_to_reset.value = "";
                        input_to_reset = document.getElementById("start_date");
                        input_to_reset.value = "";
					}
					else if(current_date > start_date_to_compare && current_date < value[i][1])
					{
						alert("Already booked for time interval "+ key + " " + value[i][1]);
                        var input_to_reset = document.getElementById("end_date");
                        input_to_reset.value = "";
                        input_to_reset = document.getElementById("start_date");
                        input_to_reset.value = "";
					}*/
   				}
			}
		});
		console.log("Here now" + selected_start_date);
		if(selected_start_date > selected_end_date)
		{
			alert("End date is less than start date. Please select again");
			var input_to_reset = document.getElementById("end_date");
			input_to_reset.value = "";
			input_to_reset = document.getElementById("start_date");
			input_to_reset.value = "";
		}
		if(selected_start_time > selected_end_time && selected_start_date == selected_end_date)
		{
			alert("Start time is greater than end time. Please select again");
			var input_to_reset = document.getElementById("end_time");
			input_to_reset.value = "";
			input_to_reset = document.getElementById("start_time");
			input_to_reset.value = "";
		}
	}

</script>
@endsection
