<?php


class Validation
{
    function email_validate($email)
    {
        $min_email_size = 2; // yu@cpp.edu
        $post_fix_size = 4; // .edu
        $post_fix_str = ".edu";

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            if (strlen($email) >= ($min_email_size + $post_fix_size))
            {
                $email_post_fix = substr($email, (strlen($email) - ($post_fix_size)));

                if (strcmp($email_post_fix, $post_fix_str) == 0)
                {
                    return Array('ERROR' => 'Ok', 'CONDITION' => true);
                }
            }
        }
        return Array('ERROR' => 'Invalid Email', 'CONDITION' => false);
    }

    function isbn_validate_and_format($isbn)
    {
        $isbn = str_replace("-", "", $isbn);

        $pattern = "/^(97(8|9))?\d{9}(\d|X)$/";

        if (is_numeric($isbn))
        {
            preg_match($pattern, $isbn, $matches);

            if (!empty($matches))
            {
                return Array('ERROR' => 'Ok', 'CONDITION' => false, 'RESULT' => $matches[0]);
            }
            else
            {
                return Array('ERROR' => 'Invalid ISBN: Includes none numerical values', 'CONDITION' => false, 'RESULT' => null);
            }
        }
        else if (!empty(preg_match($pattern, $isbn, $matches)))
        {
            if (!empty($matches))
            {
                return Array('ERROR' => 'Ok', 'CONDITION' => false, 'RESULT' => $matches[0]);
            }
            else
            {
                return Array('ERROR' => 'Invalid ISBN', 'CONDITION' => false, 'RESULT' => null);
            }
        }
        else
            return Array('ERROR' => 'Invalid ISBN', 'CONDITION' => false, 'RESULT' => null);
    }

    function name_validate($name)
    {
        $name = trim($name);

        if (strlen($name) >= 2) {
            if (ctype_alpha($name)) {
                return Array('ERROR' => 'OK', 'CONDITION' => true);
            } else {
                return Array('ERROR' => 'Invalid character(s) used', 'CONDITION' => false);
            }
        } else {
            return Array('ERROR' => 'Invalid length', 'CONDITION' => false);
        }
    }
}