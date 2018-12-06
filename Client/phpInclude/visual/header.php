<?php
 echo "
<li class=\"navMenuItem\"><a class=\"menuItemLink link\" href=\"home.php\">Home</a></li>
<li class=\"navMenuItem\"><a class=\"menuItemLink link\" href=\"search.php\">Search</a></li>
<li class=\"navMenuItem\"><a class=\"menuItemLink link\" href=\"occupied.php\">Occupancy</a></li>
<li class=\"navMenuItem\"><a class=\"menuItemLink link\" href=\"management.php\">Management</a></li>
<li class=\"profileIcon\"><a class=\"menuItemLink link\" href=\"profile.php?id={$_SESSION['loginID']}\"><i class=\"fas fa-user-alt\"></i></a></li>
 ";
?>