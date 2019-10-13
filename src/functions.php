<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */
if (!function_exists('AdminMailer'))
{
    function AdminMailer()
    {
        return app('admin-mailer');
    }
}