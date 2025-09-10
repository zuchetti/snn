<?php
// app/Helpers/SecurityHelper.php
class SecurityHelper 
{
    public static function safeTooltip($content, $title = '') 
    {
        return [
            'content' => htmlspecialchars($content, ENT_QUOTES, 'UTF-8'),
            'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
        ];
    }
    
    public static function safeDataAttribute($value) 
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}