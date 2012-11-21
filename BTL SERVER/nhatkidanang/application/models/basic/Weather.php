<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Weather extends Model {

    private $weather_id;
    private $weather_name;
    private $weather_avatar;
    private $properties = array('weather_id', 'weather_name', 'weather_avatar');

    public function __construct($data) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getWeather_id() {
        return $this->weather_id;
    }

    public function setWeather_id($weather_id) {
        $this->weather_id = $weather_id;
    }

    public function getWeather_name() {
        return $this->weather_name;
    }

    public function setWeather_name($weather_name) {
        $this->weather_name = $weather_name;
    }

    public function getWeather_avatar() {
        return $this->weather_avatar;
    }

    public function setWeather_avatar($weather_avatar) {
        $this->weather_avatar = $weather_avatar;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }



}

?>
