<?php

function statusHtml($status)
{
    switch ($status) {
    case "Approved":
        return "<span class='btn btn-success'>".$status."</span>";
    break;
    case "Rejected":
        return "<span class='btn btn-warning'>".$status."</span>";
    break;
    default:
        return "<span class='btn btn-light'>".$status."</span>";
    }
}