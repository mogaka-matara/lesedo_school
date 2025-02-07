<?php


use App\Models\Grade;

function getTotalFees($grade_id)
{
    $grade = Grade::find($grade_id);
    if (!$grade) {
        return 0;
    }
    return $grade->tuition_fee + $grade->exam_fee + $grade->transport_fee;

}
