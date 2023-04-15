<?php

function dbConn(){
      $mysqli = new mysqli(CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS, CONF_DB_SCHEMA);
      if($mysqli->error){
          return false;
      }
      return $mysqli;
}

/**
 * Funções de Filtro
 */

function remove_emoji($string)
{
    // Match Enclosed Alphanumeric Supplement
    $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
    $clear_string = preg_replace($regex_alphanumeric, '', $string);

    // Match Miscellaneous Symbols and Pictographs
    $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clear_string = preg_replace($regex_symbols, '', $clear_string);

    // Match Emoticons
    $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clear_string = preg_replace($regex_emoticons, '', $clear_string);

    // Match Transport And Map Symbols
    $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clear_string = preg_replace($regex_transport, '', $clear_string);

    // Match Supplemental Symbols and Pictographs
    $regex_supplemental = '/[\x{1F900}-\x{1F9FF}]/u';
    $clear_string = preg_replace($regex_supplemental, '', $clear_string);

    // Match Miscellaneous Symbols
    $regex_misc = '/[\x{2600}-\x{26FF}]/u';
    $clear_string = preg_replace($regex_misc, '', $clear_string);

    // Match Dingbats
    $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
    $clear_string = preg_replace($regex_dingbats, '', $clear_string);

    return $clear_string;
}

/**
 *  Funções de Datas
 */

function date_fmt(string $date = "now", string $format = "d/m/Y H\hi", string $timezone = 'America/Sao_Paulo'): string
{
    return (new DateTime($date, new DateTimeZone($timezone)))->format($format);
}

function date_fmt_br(string $date = "now", string $timezone = 'America/Sao_Paulo'): string
{
    return (new DateTime($date, new DateTimeZone($timezone)))->format(CONF_DATE_BR);
}

function date_fmt_app(string $date = "now", string $timezone = 'America/Sao_Paulo'): string
{
    return (new DateTime($date, new DateTimeZone($timezone)))->format(CONF_DATE_APP);
}

function date_fmt_file(string $date = "now", string $timezone = 'America/Sao_Paulo'): string
{
    return (new DateTime($date, new DateTimeZone($timezone)))->format(CONF_DATE_FILE);
}

function pluralize( $count, $text )
{
    return $count . (($count == 1) ? (" <span>{$text}</span>") : ($text == 'mes' ? (" <span>{$text}es</span>") : (" <span>{$text}s</span>")));
}

function ago( $datetime )
{
    $interval = date_create('now')->diff( $datetime );
    $suffix = ( $interval->invert ? ' ago' : '' );
    if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'ano' );
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'mes' );
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'dia' );
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, "hora");
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minuto' );
    return pluralize( $interval->s, "segundo");
}

/**
 *  Escolher foto de Fundo
 */

function bgComida(){

    $bg = CONF_BACKGROUND;
    $idimg = rand(0, count($bg)-1);

    return $bg[$idimg];
}

function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}