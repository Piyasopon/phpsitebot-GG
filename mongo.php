
<html>
    <head>
        <title>Site Location</title>
        <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
        <script src="liff-starter.js"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <meta charset="utf-8">
    </head>
<body>
<style>
body{
    
}
.font{
    font-size:40px;
    color:#222222;
}
.input{
    height:40px;
    width:250px;
    font-size:30px;
    border-radius: 5px;
}
.topnav {
    overflow: hidden;
    background-color:rgb(253, 187, 133);
    padding:10px;
    height:200px;
    width:300px;
    border-radius: 10px;
}
@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    [class*="input"] {
        height:90px;
        width:450px;
        font-size:60px;
        border-radius: 5px;
    }
    [class*="topnav"] {
        margin-top:20%;
        overflow: hidden;
        background-color: rgba(2, 2, 2, 0.7);
        padding:10px;
        height:400px;
        width:500px;
        border-radius: 10px;
    }
    [class*="font"] {
        font-size:80px;
    }
  }
</style>
<center><div class="topnav">
<form action="action_page.php" method="post" class="font" >
Search Site<br><input type="text" name="site" value="CMI0033" class="input"><br><br>
<input type="submit" class="input" value="Search">
</form></div></center>

</body>
</html> 