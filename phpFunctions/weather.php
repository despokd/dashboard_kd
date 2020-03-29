<?php
/**
 * Get information about weather
 *
 * @author Kilian Domaratius
 */

/**
 * Creates feed for weather
 * $location can be a U alt=""S Zip code, UK Postcode, Canada Postal code, IP address, Latitude/Longitude (decimal degree) or city name.
 *
 * @param $apiKey
 * @param string $location
 * @param string $language
 * @param bool $isCelsius
 * @param bool $isKpH
 * @param bool $isMM
 * @return string
 * @author Kilian Domaratius
 * @link https://www.weatherapi.com/
 */
function createWeatherFeed($apiKey, $location = "Dresden", $language = "en", $isCelsius = true, $isKpH = true, $isMM = true) {
    $htmlOutput = "";

    //get weather live and forecast (3-day)
    $weather = json_decode( callAPI("GET","https://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$location&days=3&lang=$language") );

    //init array for 3-day forecast with specific units
    $forecast = [array(), array(), array()];

    //set temperature units
    if ($isCelsius) {
        $str_celsius = "&nbsp;&deg;C";
        
        $current_temp_real = $weather->current->temp_c . $str_celsius;
        $current_temp_felt = $weather->current->feelslike_c . $str_celsius;
        $current_temp_min = $weather->forecast->forecastday[0]->day->mintemp_c . $str_celsius;
        $current_temp_max = $weather->forecast->forecastday[0]->day->maxtemp_c . $str_celsius;


        $forecast[0]["temp"] = $weather->forecast->forecastday[0]->day->avgtemp_c . $str_celsius;
        $forecast[0]["temp_min"] = $weather->forecast->forecastday[0]->day->mintemp_c . $str_celsius;
        $forecast[0]["temp_max"] = $weather->forecast->forecastday[0]->day->maxtemp_c . $str_celsius;
        $forecast[1]["temp"] = $weather->forecast->forecastday[1]->day->avgtemp_c . $str_celsius;
        $forecast[1]["temp_min"] = $weather->forecast->forecastday[1]->day->mintemp_c . $str_celsius;
        $forecast[1]["temp_max"] = $weather->forecast->forecastday[1]->day->maxtemp_c . $str_celsius;
        $forecast[2]["temp"] = $weather->forecast->forecastday[2]->day->avgtemp_c . $str_celsius;
        $forecast[2]["temp_min"] = $weather->forecast->forecastday[2]->day->mintemp_c . $str_celsius;
        $forecast[2]["temp_max"] = $weather->forecast->forecastday[2]->day->maxtemp_c . $str_celsius;
    } else {
        $str_fahrenheit = "&nbsp;&deg;F";
        
        $current_temp_real = $weather->current->temp_f . $str_fahrenheit;
        $current_temp_felt = $weather->current->feelslike_f . $str_fahrenheit;
        $current_temp_min = $weather->forecast->forecastday[0]->day->mintemp_f . $str_fahrenheit;
        $current_temp_max = $weather->forecast->forecastday[0]->day->maxtemp_f . $str_fahrenheit;

        $forecast[0]["temp"] = $weather->forecast->forecastday[0]->day->avgtemp_f . $str_fahrenheit;
        $forecast[0]["temp_min"] = $weather->forecast->forecastday[0]->day->mintemp_f . $str_fahrenheit;
        $forecast[0]["temp_max"] = $weather->forecast->forecastday[0]->day->maxtemp_f . $str_fahrenheit;
        $forecast[1]["temp"] = $weather->forecast->forecastday[1]->day->avgtemp_f . $str_fahrenheit;
        $forecast[1]["temp_min"] = $weather->forecast->forecastday[1]->day->mintemp_f . $str_fahrenheit;
        $forecast[1]["temp_max"] = $weather->forecast->forecastday[1]->day->maxtemp_f . $str_fahrenheit;
        $forecast[2]["temp"] = $weather->forecast->forecastday[2]->day->avgtemp_f . $str_fahrenheit;
        $forecast[2]["temp_min"] = $weather->forecast->forecastday[2]->day->mintemp_f . $str_fahrenheit;
        $forecast[2]["temp_max"] = $weather->forecast->forecastday[2]->day->maxtemp_f . $str_fahrenheit;
    }

    //set speed units
    if ($isKpH) {
        $current_wind= $weather->current->wind_kph . "&nbsp;kph";
    } else {
        $current_wind= $weather->current->wind_mph . "&nbsp;kph";
    }

    //set precipitation (rain drops)
    if ($isMM) {
        $current_precip = $weather->current->precip_mm . "&nbsp;mm";
    } else {
        $current_precip = $weather->current->precip_in . "&nbsp;in";
    }

    //start DIV container for weather
    $htmlOutput .= "<div class='feed-content'>";
        $htmlOutput .= "<h4 class='feed-contentHeading'>" . $weather->location->name . "</h4>";
        $htmlOutput .= "<div id='weather-widget' class='d-flex flex-column'>";

            /* TODO alerts
            if ( $weather->alert != array() ) {
                //create alert weather container
                $htmlOutput .= "<div id='weather-alert' class='d-flex flex-column'>";
                $htmlOutput .= "<div class='alert alert-danger' role='alert'>" . $weather->alert[0] . "</div>";
                $htmlOutput .= "</div>";
            }
            */

            //create current weather container
            $htmlOutput .= "<div id='weather-current' class='d-flex flex-column'>";

                //create current weather overview container
                $htmlOutput .= "<div id='weather-current-overview' class='d-flex flex-row'>";

                    //create current weather icon
                    $htmlOutput .= "<div id='weather-current-icon'><img src='" . str_replace("64", "128", $weather->current->condition->icon) . "' alt='Weather condition is " . $weather->current->condition->text . "' title='Weather condition is " . $weather->current->condition->text . "'></div>";

                    //create current weather quick info
                    $htmlOutput .= "<div id='weather-current-quick' class='d-flex flex-column'>";
                        $htmlOutput .= "<div id='weather-current-temp-real'>$current_temp_real</div>";
                        $htmlOutput .= "<div id='weather-current-temp-feel'>$current_temp_felt felt</div>";
                    $htmlOutput .= "</div>";

                //end current weather overview container
                $htmlOutput .= "</div>";

                //create more detail info for current weather
                $htmlOutput .= "<div id='weather-current-detail'>
                                    <table>
                                        <tr>
                                            <td class='cell-icon'><i class='fas fa-thermometer-full'></i></td>
                                            <td class='cell-name'>Max.</td>
                                            <td class='cell-unit'>$current_temp_max</td>
                                            
                                            <td class='cell-space'</td>
                                            
                                            <td class='cell-icon'><i class='fas fa-wind'></i></td>
                                            <td class='cell-name'>Wind</td>
                                            <td class='cell-unit'>$current_wind</td>
                                        </tr>
                                        <tr>
                                            <td class='cell-icon'><i class='fas fa-thermometer-empty'></i></td>
                                            <td class='cell-name'>Min.</td>
                                            <td class='cell-unit'>$current_temp_min</td>
                                            
                                            <td class='cell-space'</td>
                                            
                                            <td class='cell-icon'><i class='fas fa-cloud'></i></td>
                                            <td class='cell-name'>Clouds</td>
                                            <td class='cell-unit'>" . $weather->current->cloud . " %</td>
                                        </tr>
                                        <tr>
                                            <td class='cell-icon'><i class='far fa-sun'></i></td>
                                            <td class='cell-name'>Rise</td>
                                            <td class='cell-unit'>" . date("G:i",strtotime($weather->forecast->forecastday[0]->astro->sunrise)) . "</td>
                                            
                                            <td class='cell-space'</td>
                                            
                                            <td class='cell-icon'><i class='fas fa-cloud-showers-heavy'></i></td>
                                            <td class='cell-name'>Rain</td>
                                            <td class='cell-unit'>" . $weather->current->cloud . " %</td>
                                        </tr>
                                        <tr>
                                            <td class='cell-icon'><i class='far fa-moon'></i></td>
                                            <td class='cell-name'>Set</td>
                                            <td class='cell-unit'>" . date("G:i",strtotime($weather->forecast->forecastday[0]->astro->sunset)) . "</td>
                                            
                                            <td class='cell-space'</td>
                                            
                                            <td class='cell-icon'><i class='fas fa-tint'></i></td>
                                            <td class='cell-name'>Precip.</td>
                                            <td class='cell-unit'>$current_precip</td>
                                        </tr>
                                    </table>
                                </div>";

            //end current weather container
            $htmlOutput .= "</div><hr>";


            //create forecast weather container
            $htmlOutput .= "<div id='weather-forecast' class='d-flex flex-column'>";
            $htmlOutput .= "<table>";

            //for 3-day forecast
            for ($i = 0; $i < 3; $i++) {
                //create day forecast
                $htmlOutput .= "<tr id='weather-forecast-day$i' class='weather-forecast-day d-flex flex-row'>";
                    //create icon
                    $htmlOutput .= "<td class='weather-forecast-icon'><img src='" . $weather->forecast->forecastday[$i]->day->condition->icon . "' alt='Weather condition is " . $weather->forecast->forecastday[$i]->day->condition->text . "' title='Weather condition is " . $weather->forecast->forecastday[$i]->day->condition->text . "'></td>";
                    //create params
                    $htmlOutput .= "<td class='cell-name weather-forecast-weekday'>" . date("D", $weather->forecast->forecastday[$i]->date_epoch) . "</td>";
                    $htmlOutput .= "<td class='cell-icon'><i class='fas fa-thermometer-half'></i></td>
                                    <td class='cell-unit weather-forecast-temp'> " . $forecast[$i]["temp"] . "</td>";
                    $htmlOutput .= "<td class='cell-icon'><i class='fas fa-cloud-showers-heavy'></i></td>
                                    <td class='cell-unit weather-forecast-rain'> " . $weather->forecast->forecastday[$i]->day->avghumidity . " %</td>";
                //end day forecast
                $htmlOutput .= "</tr>";
            }

            //end forecast weather container
            $htmlOutput .= "</table>";
            $htmlOutput .= "</div>";

            //end DIV container for weather
            $htmlOutput .= "<div id='weatherApi' class='feed-copyright'><a href='https://www.weatherapi.com/' title='Free Weather API' target='_blank'><img src='//cdn.weatherapi.com/v4/images/weatherapi_logo.png' alt='Weather data by WeatherAPI.com'></a></div>";
        $htmlOutput .= "</div>";
    $htmlOutput .= "</div>";

    return $htmlOutput;
}



/**
 * Method: POST, PUT, GET etc
 * Data: array("param" => "value") ==> index.php?param=value
 *
 * @link https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php
 * @author Christoph Winkler
 *
 * @param $method
 * @param $url
 * @param bool $data
 * @return bool|string
 */
function callAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}