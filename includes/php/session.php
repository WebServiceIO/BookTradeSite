<?php
class Session
{
    public function createSessionEntry($user_id)
    {
        $fingerprint = md5(rand());
        //$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
        $_SESSION['FINGER_PRINT'] = $fingerprint;
        $_SESSION['USER_ID'] = $user_id;
        $time_stamp = $_SERVER['REQUEST_TIME'];
        $_SESSION['TIME_STAMP'] = $time_stamp;
        return array('finger_print' => $fingerprint, 'user_id' => $user_id, 'time_stamp' => $time_stamp);
    }
}
