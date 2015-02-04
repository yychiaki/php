<?php
//「1982年10月20日 13時30分45秒」のエポックタイムを生成
$afternoon = mktime(13, 30, 45, 10, 20, 1982);

print strftime('At %I:%M:%S on %m/%d/%y,', $afternoon);
print "$afternoon seconds have elapsed since 1/1/1970.";
