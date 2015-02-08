<?php
/* 密码处理 */
function pwdHash($password,$type='md5')
{
        return hash($type,$password);
}
?>