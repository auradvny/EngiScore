<?php

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role_id != 1) {
        redirect('bapendik');
    }
}
