<?php
function title(){
    $title = \App\Models\Title::all()->first();
    if (is_null($title)) {
        $title = null;
    }
    return $title;
}
