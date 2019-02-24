<!DOCTYPE html>
<html>

<head>
    <title>Feedback</title>
    <link rel="stylesheet" href="Style/style.css" type="text/css" />
    <script type="text/javascript" language="javascript" src="Script/scrip.js"></script>
</head>

<body>
    <header>
        <a href="index.html">
            <IMG class="displayed" src="Images/Lumberjack.png" alt="Store
         Logo" width="180" height="150" border="0" align="center"> </a>
    </header>
    <div class='form-wrapper'>
        <center>
			<div style='color:red;'><?=isset($_GET['msg'])?$_GET['msg']:''?></div>
            <h3>Feedback Form</h3>
            <form id='feedback-form' method='post' action='send_feedback.php'>
                <div id='error-wrapper'></div>
                <input type='text' class='form-control' id='f-name' placeholder='Enter your name' name='name'/>
                <input type='phone' class='form-control' id='f-phone' placeholder='Enter your phone number' name='phone' />
                <textarea class='form-control' id='f-feedback' placeholder="Enter your feedback here.." rows='5' name='feedback'></textarea>
                <input type='submit' class='form-control btn' value='submit' id='submit-feedback' /> </form>
        </center>
    </div>
    </div>
</body>

</html>
