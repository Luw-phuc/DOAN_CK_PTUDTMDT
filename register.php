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

  $userFullName = $user["firstname"] ." ". $user["lastname"];

  $hexInput = $user["id"];
  if (strlen($hexInput) % 2 != 0) {
      $hexInput = "0" . $hexInput; // Add a leading zero to make the length even
  }

  switch ($_POST["phase"]) {
    // (B) REGISTRATION PART 1 - GET ARGUMENTS
    case "a":
      $args = $WebAuthn->getCreateArgs(
        \hex2bin($hexInput), $user["email"], $userFullName, 
        30, false, true
      );
      $_SESSION["challenge"] = ($WebAuthn->getChallenge())->getBinaryString();
      echo json_encode($args);
      break;
    // (C) REGISTRATION PART 2 - SAVE USER CREDENTIAL
    // should be saved in database, but we save into a file instead
    case "b":
      // (C1) VALIDATE & PROCESS
      try {
        $data = $WebAuthn->processCreate(
          base64_decode($_POST["client"]),
          base64_decode($_POST["attest"]),
          $_SESSION["challenge"],
          true, true, false
        );
      } catch (Exception $ex) { exit("ERROR - "); print_r($ex); }
      
      // (C2) SAVE
      $encodedData = serialize($data);
      $updateAccount = "UPDATE `account` SET credential = :credential WHERE id = :id;";
      $stmtAccount = $pdo->prepare($updateAccount);
      $stmtAccount->bindParam(":credential", $encodedData, PDO::PARAM_LOB);
      $stmtAccount->bindParam(":id", $user["id"]);
      $stmtAccount->execute();

      file_put_contents($saveto, serialize($data));

      echo "OK";
      break;
  }
} catch (PDOException $e) {
  die("Failed to connect to the database: " . $e->getMessage());
} finally {
  $pdo = null;
  $stmt = null;
}