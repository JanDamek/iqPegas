<?php

function custom_time_ago_in_words($from_time, $to_time = null, $include_seconds = false)
{
  $to_time = $to_time? $to_time: time();

  $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
  $distance_in_seconds = floor(abs($to_time - $from_time));

  $string = '';
  $parameters = array();

  if ($distance_in_minutes <= 1)
  {
    if (!$include_seconds)
    {
      $string = $distance_in_minutes == 0 ? 'před méně než minutou' : 'před minutou';
    }
    else
    {
      if ($distance_in_seconds <= 5)
      {
        $string = 'před méně než 5 vteřinami';
      }
      else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
      {
        $string = 'před méně než 10 vteřinami';
      }
      else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
      {
        $string = 'před méně než 20 vteřinami';
      }
      else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
      {
        $string = 'před půl minutou';
      }
      else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
      {
        $string = 'před méně než minutou';
      }
      else
      {
        $string = 'před minutou';
      }
    }
  }
  else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
  {
    $string = 'před %minutes% minutami';
    $parameters['%minutes%'] = $distance_in_minutes;
  }
  else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
  {
    $string = 'přibližně před hodinou';
  }
  else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
  {
    $string = 'před %hours% hodinami';
    $parameters['%hours%'] = round($distance_in_minutes / 60);
  }
  else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
  {
    $string = 'včera';
  }
  else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
  {
    $string = 'před %days% dny';
    $parameters['%days%'] = round($distance_in_minutes / 1440);
  }
  else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
  {
    $string = 'před měsícem';
  }
  else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
  {
    $parameters['%months%'] = round($distance_in_minutes / 43200);
    switch ($parameters['%months%'])
    {
        case 1:
            $string = 'před %months% měsícem';

            break;

        default:
            $string = 'před %months% měsíci';
            break;
    }
  }
  else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
  {
    $string = 'před rokem';
  }
  else
  {
    $string = 'před více než %years% lety';
    $parameters['%years%'] = floor($distance_in_minutes / 525960);
  }

  return strtr($string, $parameters);
}