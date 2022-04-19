<?php

if( empty( $_SESSION["user"] ) ){

include "include/menu.php";

} else {

include "include/menu-user.php";

}