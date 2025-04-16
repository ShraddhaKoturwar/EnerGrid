<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ruleName = $_POST['rule_name'] ?? '';
    $isActive = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 0;

    if ($ruleName !== '') {
        $stmt = $pdo->prepare("UPDATE settings SET is_active = ? WHERE rule_name = ?");
        $success = $stmt->execute([$isActive, $ruleName]);
        echo $success ? 'success' : 'fail';
        exit;
    }
}

echo 'fail';
