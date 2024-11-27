<?php
include 'db.php';

$query = "SELECT * FROM questions";
$questions = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philippine History Quiz App</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            flex-direction: column;
            overflow-y: auto;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
            width: 100%;  
        }

        .quiz-form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            box-sizing: border-box;
            margin: 0 auto;
            overflow-y: auto;
            height: calc(100vh - 100px); 
        }

        .question-container {
            margin-bottom: 20px;
        }

        h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .choices-container {
            margin-left: 20px;
            margin-top: 10px;
        }

        .choice-label {
            font-size: 14px;
            display: block;
            margin: 5px 0;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 50%;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .question-container {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .choice-label input {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <h1>Philippine History Quiz App</h1>

    <form action="submit.php" method="POST" class="quiz-form">
        <?php foreach ($questions as $question): ?>
            <div class="question-container">
                <h3><?php echo $question['question_text']; ?></h3>
                <?php
              
                $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
                $stmt->execute([$question['id']]);
                $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="choices-container">
                    <?php foreach ($answers as $answer): ?>
                        <label class="choice-label">
                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $answer['id']; ?>" required>
                            <?php echo $answer['answer_text']; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="submit-btn">Submit Quiz</button>
    </form>

</body>
</html>
