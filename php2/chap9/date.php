<?php
print 'strftime() says:';
print strftime('%c');
print '<br />';
print 'date() says:';
print date('r');
print '<br />';
print date('m/d/Y');
print '<br />';
print strftime('%m/%d/%Y');
print '<br />';
print date('h:i:s',time());
print '<br />';
//1hore追加
print date('h:i:s',time() + 60*60);
print '<br />';
print strftime('%I:%M:%S');
print '<br />';
print strftime('Today is %m/%d/%y and the time is %I:%M:%S');
print '<br />';
print 'Today is '. date('m/d/y') . ' and the time is' .date('h:i:s');
