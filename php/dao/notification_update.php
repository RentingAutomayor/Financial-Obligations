<?php
#Author: LAURA GRISALES
#Date: 28/08/2020
#Description : Is DAO notification update
include "../class/connectionDB.php";
class NotificationUpdate
{
  private $objConntion;
  private $arrayResult;
  private $intValidatio;

  public function __construct()
  {
    $this->objConntion = new Connection();
    $this->arrayResult = array();
    $this->intValidatio;
  }

  #Description: Function for update credits forms in notification
  public function notificationUpdateCredits()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_notification_credit()")) {
          $row = $result->fetch_array(MYSQLI_ASSOC);
          $this->arrayResult[] = $row;
          mysqli_free_result($result);
          $this->intValidatio = 1;
        }
      }
      $con->close();     
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
    return $this->intValidatio;
  }
  #Description: Function for update memberships forms in notification
  public function notificationUpdateMemberships()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_notification_membership()")) {
          $row = $result->fetch_array(MYSQLI_ASSOC);
          $this->arrayResult[] = $row;
          mysqli_free_result($result);
          $this->intValidatio = 1;
        }
      }
      $con->close();     
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
    return $this->intValidatio;
  }
  
}
$getData = file_get_contents('php://input');
$data = json_decode($getData);
/**********CREATE ************/
$mail=new NotificationUpdate();
$mail->notificationUpdateCredits();      
$mail->notificationUpdateMemberships();      
?>

