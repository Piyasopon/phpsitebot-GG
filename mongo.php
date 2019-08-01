
<html>
<body>
<style>
body{
    
}
.font{
    font-size:40px;
    color:#cccccc;
}
.input{
    height:40px;
    width:250px;
    font-size:30px;
    border-radius: 5px;
}
.topnav {
    overflow: hidden;
    background-image: url("74035910-rock-textured-background-in-a-black-and-white-light-and-low-contrast-tonality.jpg");
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
<form action="action_page.php" method="post" class="font">
Search Site<br><input type="text" name="site" value="CMI0033" class="input"><br><br>
<input type="submit" class="input" value="Search">
</form></div></center>

</body>
</html> 