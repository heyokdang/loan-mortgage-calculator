<?php

$d = "Oct 2015";

$da = new DateTime($d);

$f = strtotime("+1 months", strtotime($d));
echo strtotime($d);
echo "<br />";
echo date('Y-m-d',strtotime($d));
echo "<br />";
echo $f;
echo "<br />";
echo date('M Y',$f);
echo "<br />";
echo date('M Y');
// echo $f->format('Y-m-d H:i:s');