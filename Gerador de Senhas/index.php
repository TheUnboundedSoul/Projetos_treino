<?php

if(isset($_POST['length'])) {
    $length = intval($_POST['length']);
    $lowercase = isset($_POST['lowercase']);
    $uppercase = isset($_POST['uppercase']);
    $symbols = isset($_POST['symbols']);
    $numbers = isset($_POST['numbers']);

    if(!$lowercase && !$uppercase && !$symbols && !$numbers) {
        echo "Failed to generate password. choose at least 1 type;";
    }

    $lowercase_chars = "abcdefghijklmnopqrstuvwxyz";
    $uppercase_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $symbols_chars = "!@#$%*()_+=";
    $numbers_chars = "0123456789";

    $password = "";
    $validoptions = "";
    

    if($lowercase) {
        $validoptions .= $lowercase_chars;
    }

    if($uppercase) {
        $validoptions .= $uppercase_chars;
    }

    if($symbols) {
        $validoptions .= $symbols_chars;
    }

    if($numbers) {
        $validoptions .= $numbers_chars;
    }

    for($k = 0; $k < $length; $k++) {
        $random_number = rand(0, strlen($validoptions) -1);
        $password .= $validoptions[$random_number];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
</head>
<body>
    <h4>Generate a Password</h4>

    <form method="post" action="">
        <p>
            <label for="">Password Length</label>
            <input type="number" min="8" value="16" name="length">
        </p>
        <p>
            <label for="">Include Lower Case</label>
            <Input type="checkbox" value="1" checked name="lowercase"></Input>
        </p>
        <p>
            <label for="">Include Uppercase</label>
            <input type="checkbox" value="1" checked name="uppercase">
        </p>
        <p>
            <label for="">Include Symbols</label>
            <input type="checkbox" value="1" checked name="symbols">
        </p>
        <p>
            <label for="">Include Numbers</label>
            <input type="checkbox" value="1" checked name="numbers">
        </p>
        <p>
            <button>Generate!</button>
        </p>
    </form>

    <?php if(isset($password)) { ?>
        <h4>Generated Password</h4>
        <input type="text" readonly value="<?php echo $password; ?>">
    <?php } ?>
</body>
</html>