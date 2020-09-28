function nc($n='1290') {
    $n = (0+str_replace(",", "", $n));

    if (!is_numeric($n)) return false;

    if($n>1000000000000) return round(($n/1000000000000), 2).'T';
    elseif ($n>1000000000) return round(($n/1000000000), 2).'B';
    elseif ($n>1000000) return round(($n/1000000), 2).'M';
    elseif ($n>1000) return round(($n/1000), 2).'K';
    return number_format($n);
    //return number_format($n);
}
