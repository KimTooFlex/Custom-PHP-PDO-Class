<?php
/*
* Copyright (C) 2017
*BUNIFU TECHNOLOGIES

* This program is NOT A free software: you can MAY NOT redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://www.bunifu.co.ke>.
*/

// MySQL Class v0.8.1

class PDOclass{

 //-------confiqure Local---------
    var $hostname='localhost';    // MySQL Hostname
    var $username='root';        // MySQL Username
    var $password='';            // MySQL Password
    var $database='wpmvc';        // MySQL Database
    var $driver='mysql:host';
    var  $PRODUCTION_HOST="your_host_prefix";  //e.g  bunifu




	//db objects
         var $pdo;
		     var $query;

        /* *******************
         * Class Constructor *
         * *******************/

        function PDOclass(){

          if( strpos(strtolower($_SERVER['HTTP_HOST']), strtolower($this->PRODUCTION_HOST))!== false)
          {
                error_reporting(E_ALL ^ E_DEPRECATED);

                //-------confiqure Production---------
                 $this->hostname='localhost';    // MySQL Hostname
                 $this->username='username';        // MySQL Username
                 $this->password='password';            // MySQL Password
                 $this->database='database_name';        // MySQL Database
                 $this->river='mysql:host';
          }

                $this->Connect();
        }

        /* *******************
         * Private Functions *
         * *******************/

		  // Connects class to database


      function connect(){

				$this->pdo=new PDO($this->driver.'='.$this->hostname.';dbname='.$this->database,$this->username,$this->password);

        }

	   function useDb($db){

				$this->pdo=new PDO('mysql:host='.$this->hostname.';dbname='.$db,$this->username,$this->password);

        }

        /* *******************
         * Public Functions *
         * *******************/



		//return pdo object
		 function ExecuteSQL($sql){
			if(strpos(strtolower(trim($sql)),"select")==0)
			{
				$this->query=$this->pdo->query($sql);
        if($this->query)
        {
              return($this->query->fetchAll(PDO::FETCH_ASSOC));

        }
        else
        {
              echo null;

        }

			}
			else
			{

				return($this->pdo->exec($sql));

			}

	     }

        // Performs a 'mysql_real_escape_string' on the entire array/string
        public function SecureData($data){


			   //more code



				$data=str_replace("'","",$data);
                return $data;
        }


			//execute multiple querries
			 function ExecuteMultiple($sqlq)
			 {
				// Split
				$arr =explode(";",$sqlq);
				 foreach($arr as $sql)
				 {
				   $this->ExecuteSQL($sql.";") ;
				 }

			 }

}
?>
