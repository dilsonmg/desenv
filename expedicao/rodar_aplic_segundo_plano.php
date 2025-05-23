<?php
//$PID = shell_exec("cd ..; ./shoutcast/sc_serv");
//$PID = shell_exec("kill 8409");

//echo"$PID";
?> 

<?php
/**
 * @author    Ashraf M Kaabi
 * @name      Advance Linux Exec
 */
class exec {
   /**
     * Run Application in background
     *
     * @param    unknown_type $Command
     * @param    unknown_type $Priority
     * @return    PID
     */
   function background($Command, $Priority = 0){
       if($Priority)
           $PID = shell_exec("nohup nice -n $Priority $Command > /dev/null & echo $!");
       else
           $PID = shell_exec("nohup $Command > /dev/null & echo $!");
       return($PID);
   }
   /**
   * Check if the Application running !
   *
   * @param    unknown_type $PID
   * @return    boolen
   */
   function is_running($PID){
       exec("ps $PID", $ProcessState);
       return(count($ProcessState) >= 2);
   }
   /**
   * Kill Application PID
   *
   * @param  unknown_type $PID
   * @return boolen
   */
   function kill($PID){
       if(exec::is_running($PID)){
           exec("kill -KILL $PID");
           return true;
       }else return false;
   }
};

//background("cd ..; ./shoutcast/sc_serv");

$CallClass = new exec;
$CallClass->background("cd ..; ./shoutcast/sc_serv");
?> 