<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Datestr.php
 *
 * A few simple filters for Twig/Codeigniter to format a date as a human friendly string
 * based on its relation to the current date/time
 *
 * Requires: https://github.com/bmatschullat/Twig-Codeigniter
 * 
 * See the readme for usage: https://github.com/kissit/Twig-Codeigniter-Datestr/blob/master/README.md
 *
 * Copyright (C) 2016 KISS IT Consulting <http://www.kissitconsulting.com/>
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above
 *    copyright notice, this list of conditions and the following
 *    disclaimer in the documentation and/or other materials
 *    provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL ANY
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

class Twig_Extensions_Extension_Datestr extends Twig_Extension {
    
    public function getFilters() {
        return array(
            new Twig_SimpleFilter('minhrday', 'twig_minhrday_filter'),
            new Twig_SimpleFilter('timeday', 'twig_timeday_filter'),
        );
    }

    public function getName() {
        return 'Datestr';
    }
}

global $datestr_current; 
$datestr_current = date('Y-m-d H:i:s');
function twig_minhrday_filter($value) {
    global $datestr_current;
    $difftime = new DateTime($value);
    $current = new DateTime($datestr_current);
    $diff = $difftime->diff($current);
    if($diff->y > 0 || $diff->m > 0) {
        return $difftime->format("M 'y");
    } elseif ($diff->d > 0) {
        return $diff->d . 'd';
    } elseif ($diff->h > 0) {
        return $diff->h . 'h';
    } elseif ($diff->i > 0) {
        return $diff->i . 'm';
    } else {
        return '1m';
    }
}

function twig_timeday_filter($value) {
    global $datestr_current;
    $difftime = new DateTime($value);
    $current = new DateTime($datestr_current);
    $diff = $difftime->diff($current);
    if($diff->y > 0) {
        return $difftime->format("M d 'y");
    } elseif ($diff->m > 0 || $diff->d > 0) {
        return $difftime->format("M d");
    } else {
        return $difftime->format("h:i A");
    }
}
