<?php
////////////////// Database Settings Go Here /////////////////////////////
// Change these settings for database
//////////////////////////////////////////////////////////////////////////
	
	
	
	class wxg_mysqli extends mysqli {
    public function __construct($mysqlhost, $mysqluser, $mysqlpass, $mysqldbname) {
        parent::init();

        if (!parent::options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
            die('Setting MYSQLI_INIT_COMMAND failed');
        }

        if (!parent::options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
            die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
        }

        if (!parent::real_connect($mysqlhost, $mysqluser, $mysqlpass, $mysqldbname)) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }
}
?>