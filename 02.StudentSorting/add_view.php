<!DOCTYPE html>
<html>
    <head>
        <style>
            table {border: 1px solid black}
            th {min-width: 150px; text-align: left;}
            #exam {max-width: 120px;}
        </style>
        <meta charset="utf-8">
        <title>Student sorting</title>
    </head>
    <body>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>First name:</th>
                        <th>Last name:</th>
                        <th>Email:</th>
                        <th>Exam score:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="first_name" placeholder="Enter first name...">
                        </td>
                        <td>
                            <input type="text" name="last_name" placeholder="Enter last name...">
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter email...">
                        </td>
                        <td>
                        <input id="exam" type="number" name="score" placeholder="Enter score...">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <input type="submit" name="add" value="Add student">
            </div> 
        </form>
    </body>
</html>