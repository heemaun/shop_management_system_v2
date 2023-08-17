<?php

use App\Models\Status;

function getDeletedStatusId()
{
    return Status::where('name','Deleted')->first()->id;
}

function getNonDeletedStatusesIds()
{
    return Status::where('name','!=','Deleted')->get('id');
}

function getActiveStatusId()
{
    return Status::where('name','Active')->first()->id;
}

function getStatusID($name)
{
    $status = Status::where('name',$name)->first();

    if($status !== null){
        return $status->id;
    }

    return null;
}

// function getCurrencyFormat($number)
// {
//     $locale = 'bn_BD';
//     $style = NumberFormatter::CURRENCY;
//     $precision = 2;
//     $groupingUsed = true;
//     $currencyCode = 'IDR';

//     $formatter = New NumberFormatter($locale,$style);
//     $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,$precision);
//     $formatter->setAttribute(NumberFormatter::GROUPING_USED,$groupingUsed);

//     if($style == NumberFormatter::CURRENCY){
//         $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE,$currencyCode);
//     }

//     return $formatter->format($number);
// }

?>