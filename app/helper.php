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

?>