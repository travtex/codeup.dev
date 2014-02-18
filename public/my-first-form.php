
<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>


<!DOCTYPE html>
<html>
<head>
	<title>My First Codeup Form</title>
</head>
	<body>
        <div style="background:-webkit-linear-gradient(left top, moccasin, white);">
    		<form method="POST" action="">
        <p>
            <label for="username">Username:</label>
            <input id="username" name="username" type="text" placeholder="Your Username">
        </p>
        <p>
            <label for="password">Password:</label>
            <input id="password" name="password" type="password" placeholder="Your Password">
        </p>
        <p>
            <input type="submit" value="Login">
        </p>
            </form>
        <hr />
            <form method="POST" action="">
                <p>
                    <label for="to">To:</label>
                    <input id="to" name="to" type="text" placeholder="Recipient">
                </p>
                <p>
                    <label for="from">From:</label>
                    <input type="text" id="from" name="from" placeholder="Sender">
                </p>
                <p>
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject">
                </p>
                <p>
                    <label for="email_body">Body:</label>
                    <textarea id="email_body" name="email_body" rows="5" cols="30" placeholder="Message here."></textarea>
                </p>
                <label for="save_email">
                    <input type="checkbox" id="save_email" name="save_email" value="yes" checked>
                    Do you want to save a copy?
                </label>
                <p>
                    <input type="submit" value="Send Email">
                </p>
            </form>
        <hr />
        <h2 style="text-align:center; color:darkgreen; text-decoration:underline">Multiple Choice Test</h2>
            <form method="POST" action="">
                
                    <h4>What is your favorite color?</h4>
                        <label for="q1a" style="color:navy; font-size:18px;">
                            <input type="radio" id="q1a" name="q1" value="navy">
                            Navy
                        </label>
                        <label for="q1b" style="color:indigo; font-size:18px;">
                            <input type="radio" id="q1b" name="q1" value="indigo">
                            Indigo
                        </label>
                        <label for="q1c" style="color:firebrick; font-size:18px;">
                            <input type="radio" id="q1c" name="q1" value="firebrick">
                            FireBrick
                        </label>
                        <label for="q1d" style="color:darkslategray; font-size:18px;">
                            <input type="radio" id="q1d" name="q1" value="darkslategray">
                            DarkSlateGray
                        </label>

                    <h4>What is your favorite text tag?</h4>
                        <label for="q2a" style="font-size:18px;">
                            <input type="radio" id="q2a" name="q2" value="strong">
                            <strong>Strong</strong>
                        </label>
                        <label for="q2b" style="font-size:18px;">
                            <input type="radio" id="q2b" name="q2" value="emphasis">
                            <em>Emphasis</em>
                        </label>
                        <label for="q2c" style="font-size:18px;">
                            <input type="radio" id="q2c" name="q2" value="small">
                            <small>Small</small>
                        </label>   
                        <label for="q2d" style="font-size:18px;">
                            <input type="radio" id="q2d" name="q2" value="mark">
                            <mark>Mark</mark>
                        </label>
                        <p>
                            <input type="submit" value="I'm Done!">
                        </p>
            </form>
            <br />
            <hr /> 

            <form method="GET" action="">
                <br />
                <h4>Select Testing:</h4>
                <label for="select" style="font-size:18px;">Is This a Select Box?</label>
                    <select id="select" name="select">
                        <option value="1" selected>YES!!</option>
                        <option value="0">NO!!</option>
                    </select>
                    <p>
                        <input type="submit" value="Answer">
                    </p>
                </form>
                <br />
                <hr />
        </div>
	</body>
</html>