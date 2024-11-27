<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    $totalQuestions = 0;

    // Iterate over each question
    foreach ($_POST as $key => $answerId) {
        // Extract question_id from the input name (e.g., question_1 => 1)
        if (preg_match('/question_(\d+)/', $key, $matches)) {
            $questionId = $matches[1];
            $stmt = $pdo->prepare("SELECT is_correct FROM answers WHERE id = ?");
            $stmt->execute([$answerId]);
            $answer = $stmt->fetch(PDO::FETCH_ASSOC);

            // Increment score if the answer is correct
            if ($answer && $answer['is_correct'] == 1) {
                $score++;
            }
            $totalQuestions++;
        }
    }

    echo "<h1>Your Score: $score out of $totalQuestions</h1>";
}
?>
