<?php
class Tableau
{
    public static function td($par = "")
    {
        echo '<td>' . $par . '</td>';
    }
    public static function th($par = "")
    {
        echo '<th scope="col">' . $par . '</th>';
    }
}
