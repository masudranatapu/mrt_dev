<?php

namespace App\Utils;

class GlobalConstantEnum
{
    const LOGIN_TYPE = ['Login', 'Logout'];
    const STATUS = ['Active', 'Inactive'];
    const USER_STATUS = ['Active', 'Inactive', 'Blocked', 'Pending'];
    const GENDER = ['Male', 'Female', 'Other'];
    const YESNO = ['Yes', 'No'];
    const THEME_MOOD = ['light', 'dark'];
    const DEFAULT_LANGUAGE = ['en', 'bn', 'ar'];
    const SMS_TYPE = ['Masking', 'Non Masking'];
    const SMS_STATUS = ['Sent', 'Failed'];
    const SEND_TYPE = ['Test', 'Live'];
}
