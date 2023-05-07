<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="file.css">
    <title>file handeling</title>
</head>
    
<body>
	<div id="page-wrap">
		<h1>File operations using PHP</h1>
		<form action="" method="post" id="quiz-form">
            <table id="intro">
                <tr>
                    <td><label>Write the name of file here:</label></td>
                    <td><input type="text" name="filename" id="filename" placeholder="Please enter name of File" /></td>
                </tr>
                <tr>
                    <td><label>Write the text to update the file:</label></td>
                    <td><textarea name="writetext" id="writetext" placeholder="Please enter text to write or append" /></textarea></td>
                </tr>
            </table>

            <h2>Please choose the operation to perform:</h2>

            <table id="op">
                <tr>
                    <td><input type="submit" name="OpenCreate" id="OpenCreate" value="Click to Open and Read File" /></td>
                    <td><input type="submit" name="delete" id="delete" value="Click to Delete File" /></td>
                </tr>
                <tr>
                    <td><input type="submit" name="Write" id="Write" value="Click to Create or Write text in file" /></td>
                    <td><input type="submit" name="Append" id="Append" value="Click to Append text in file" /></td>
                </tr>
            </table>
		</form>
        
        <h4>The Result of operation is displayed here: </h4>

        <div id="res">
        <?php
        if (isset($_POST['OpenCreate'])) {
            $file = $_POST['filename'];

            if($file=='')
                echo 'Write the name of file name in the given text box.';

            else {
            if(array_key_exists('OpenCreate', $_POST)) {
                $myfile = fopen($file, "r") or die("Unable to open file!");
                echo 'The contents of'.$file.' is:<br><br>';
                while(!feof($myfile)){
                    echo fgets($myfile)."<br>";
                }
                fclose($myfile);
            }
        }
        }
        else if(array_key_exists('Write', $_POST)) {
            if (isset($_POST['Write'])) {
                $txt = $_POST['writetext'];
                $file = $_POST['filename'];
                if($file=='')
                    echo 'Write the name of file name in the given text box.';

            else {
                $myfile = fopen($file, "w") or die("Unable to open file!");
                fwrite($myfile, $txt);
                echo 'Text has been written to the file. Click on Open/create to check.';
                fclose($myfile);
            }
            }
        }
        else if(array_key_exists('Append', $_POST)) {
            if (isset($_POST['Append'])) {
                $txt = $_POST['writetext'];
                $txt = '<br>'.$txt;
                $file = $_POST['filename'];
                $myfile = fopen($file, "a") or die("Unable to open file!");
                fwrite($myfile, $txt);
                echo 'Text has been appended to the file. Click on read file to check.';
                fclose($myfile);
            };
        }
        else if(array_key_exists('delete', $_POST)) {
            if (isset($_POST['delete'])) {
                $file = $_POST['filename'];
                if(file_exists($file)){
                    unlink($file);
                    echo $file.' has been deleted successfully.';
                }
                else
                    echo $file.' does not exist.';
            }
        }
        ?>

		</div>
	</div>
</body>
</html>