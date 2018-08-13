<?php

echo 'Date: ' . date('Y-m-d H:i:s'); // Result: 2017-02-19 03:21:31 (GMT + 1) - my current timezone
echo '<br>';
echo 'Timestamp: ' . time(); // Result: 1487470891 (GMT + 0)
echo '<br>';echo '<br>';
//date_default_timezone_set('UTC');
echo 'Date: ' . date('Y-m-d H:i:s');echo '<br>'; // Result: 2017-02-19 02:21:31 (GMT + 0)
echo 'Timestamp: ' . time(); // Result: 1487470891 (GMT + 0)

echo '<hr>';

echo 'Now: ' . date('Y-m-d H:i:s');
echo '<br>';
echo 'Next minute: ' . date('Y-m-d H:i:s', time() + 60);
echo '<br>';
echo 'Next hour: ' . date('Y-m-d H:i:s', time() + (60 * 60));

echo '<hr>';

echo mktime (date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));

echo '<hr>';

echo date('d-m-Y', mktime(0,0,0,1,1,2017)); // 01-01-2017
echo '<br>';
echo date('d-m-Y', mktime(0,0,0,1,0,2017)); // 31-12-2016
echo '<br>';
echo date('d-m-Y', mktime(0,0,0,1,-1,2017)); // 30-12-2016

echo '<hr>';

date_default_timezone_set("Europe/London");
echo date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y')));
echo '<br>';
echo date('Y-m-d H:i:s', gmmktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y')));

echo '<hr>';

$timestamp = strtotime('now'); // 1488236400
echo date('d-m-Y', strtotime('+1 day', $timestamp)); // 01-03-2017

echo '<hr>';

echo date('Y-m-d H:i:s'); // 2017-02-19 09:37:48
echo '<br>';
echo date('Y-m-d H:i:s', strtotime('next month')); // 2017-03-19 09:37:48
echo '<br>';
echo date('Y-m-d H:i:s', strtotime('previous day')); // 2017-02-18 09:37:48
echo '<br>';
echo date('Y-m-d H:i:s', strtotime('previous hour')); // 2017-02-19 08:37:48

echo '<hr>';


$today = date("D");

switch($today){

    case "Mon":

        echo "Today is Monday. Clean your house.";

        break;

    case "Tue":

        echo "Today is Tuesday. Buy some food.";

        break;

    case "Wed":

        echo "Today is Wednesday. Visit a doctor.";

        break;

    case "Thu":

        echo "Today is Thursday. Repair your car.";

        break;

    case "Fri":

        echo "Today is Friday. Party tonight.";

        break;

    case "Sat":

        echo "Today is Saturday. Its movie time.";

        break;

    case "Sun":

        echo "Today is Sunday. Do some rest.";

        break;

    default:

        echo "No information available for that day.";

        break;

}