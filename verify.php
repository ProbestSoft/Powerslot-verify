<?php
function hash_verify($last_hash, $req_count) {
    if (mb_strlen($last_hash) !== 64) {
        return false;
    }

    $ret = [];
    for ($i = 0; $i < $req_count; $i++) {
        $available = [];
        $selected_balls = [];
        for ($j = 1; $j <= 28; $j++) array_push($available, $j);
        for ($j = 0; $j < 7; $j++) {
            $num = intval(substr($last_hash, 8 * $j, 8), 16);
            if ($j === 5) {
                array_push($selected_balls, $num % 10);
            } else {
                array_push($selected_balls, array_splice($available, $num % sizeof($available), 1)[0]);
            }
        }
        $ret[$last_hash] = $selected_balls;
        $last_hash = hash("sha256", $last_hash);
    }

    return $ret;
}
?>
