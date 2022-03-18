<!DOCTYPE html>
<html>
    <head>
        <style>
            table {border: 1px solid black}
            th {min-width: 150px; text-align: left;}
            #submit {color: white; font-weight: bold; background-color: #3f68b0; 
                    min-width: 100px; padding: 2px}
        </style>
        <meta charset="utf-8">
        <title>Student sorting</title>
    </head>
    <body>
        <div>
            <h3>Latest results:</h3>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>First name</th> 
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Exam score</th>    
                    </tr>
                </thead>
                <tbody>
                <?php if (count($_SESSION['student']) > 0) :
                    $averageScore = 0;
                    foreach ($_SESSION['student'] as $student) : ?>
                    <tr>
                        <td><?= $student["firstName"]; ?></td>
                        <td><?= $student["lastName"]; ?></td>
                        <td><?= $student["email"]; ?></td>
                        <td><?= $student["score"]; ?></td>
                    </tr>
                    <?php 
                    $averageScore += $student["score"];
                    endforeach; 
                endif; ?>
                    <tr>
                        <td align="center" colspan="3"><span style="text-decoration: underline;">Average score: </span></td>
                        <td><span style="text-decoration: underline;">
                            <?php if (count($_SESSION['student']) > 0) :
                            echo round(($averageScore / count($_SESSION['student'])), 2);
                            endif; ?>
                        </span></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <form method="POST">
                    <label>Sort by:</label>
                        <select name="sortBy">
                            <option value="-1">-- Select filter --</option>
                            <option value="fname" <?= ($sortBy == "fname") ? 'selected' : ''; ?>>First name</option>
                            <option value="lname" <?= ($sortBy == "lname") ? 'selected' : ''; ?>>Last name</option>
                            <option value="email" <?= ($sortBy == "email") ? 'selected' : ''; ?>>Email</option>
                            <option value="exam" <?= ($sortBy == "exam") ? 'selected' : ''; ?>>Exam score</option>
                        </select>
                            <label>Order:</label>
                            <select name="order">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        <input type="submit" name="sort" value="SORT" id="submit">
                        <a href="add.php">Add new student:</a>
                </form>
            </div>
    </body>
</html>