<html>
    <head>
        <style>
/* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #1e3c72, #2a5298);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #fff;
}

/* Form Container */
form {
    background: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 300px;
    text-align: center;
    color: #333;
}

/* Form Heading */
h1 {
    text-align: center;
    color: #fff;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

/* Input Fields */
label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
    text-align: left;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Button */
button {
    background: #1e3c72;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
    width: 100%;
}

button:hover {
    background: #162e59;
}

/* Add Margin to Form */
form {
    margin-top: -50px; /* Optional: adjusts form position */
}

        </style>
    </head>
    <body>
    <body>
  
    <form method="POST" action="user_registration_process.php">
    <h1>User Registration</h1>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Voter Id:</label>
        <input type="text" name="voter_id" required><br>
        <button type="submit">Register</button>
    </form>
</body>
    </body>
</html>