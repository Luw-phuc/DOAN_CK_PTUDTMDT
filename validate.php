<?php
// (A) INIT & CHECK
require "init.php";
require_once "include/db.inc.php";

try {
  $query = "SELECT * FROM account WHERE id = :id;";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":id", $_SESSION["user_id"]);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user["credential"] != null) {
    $saved = unserialize($user["credential"]);
  
    switch ($_POST["phase"]) {
      // (B) VALIDATION PART 1 - GET ARGUMENTS
      case "a":
        $args = $WebAuthn->getGetArgs([$saved->credentialId], 30);
        $_SESSION["challenge"] = ($WebAuthn->getChallenge())->getBinaryString();
        echo json_encode($args);
        break;
     
      // (C) VALIDATION PART 2 - CHECKS & PROCESS
      case "b":
        $id = base64_decode($_POST["id"]);
        if ($saved->credentialId !== $id) { exit("Invalid credentials"); }
        try {
          $WebAuthn->processGet(
            base64_decode($_POST["client"]),
            base64_decode($_POST["auth"]),
            base64_decode($_POST["sig"]),
            $saved->credentialPublicKey,
            $_SESSION["challenge"]
          );
          $query = "SELECT * FROM card WHERE account_id = :id;";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(":id", $_SESSION["user_id"]);
          $stmt->execute();
          $card = $stmt->fetch(PDO::FETCH_ASSOC);

          // echo "OK";
          // DO WHATEVER IS REQUIRED AFTER VALIDATION

          echo json_encode($card);

        } catch (Exception $ex) { echo "ERROR - "; print_r($ex); }
        break;
    }
  }
} catch (Exception $e) {
  echo "". $e->getMessage() ."";
} finally {
  $pdo = null;
  $stmt = null;
}
 
