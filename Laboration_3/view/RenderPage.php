<?php

namespace view;

class RenderPage{
    
    public function renderOutput($body){
        echo '<!DOCTYPE html>

		<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
		<head>
		    <meta charset="utf-8" />
		    <link rel="stylesheet" href="">
		    <title>Booking app</title>
		</head>
		<body>
                    <h1>Booking page</h1>
                    <form method="POST" action="">
                    ' . $body . '
                    </form>
		</body>
		</html>
		';
    }
}