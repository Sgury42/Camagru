function verifyEmail()
{
    var email = prompt("Please enter your email:");
    if (email !== null) {
        $.ajax({
                type: "POST",
                url: "model/user.php",
                data: email,
                success: function(response) {
                    alert("Email has been resend, check your mailbox !");
                }
            });
    }
}

function closeAlert(id)
{
    // var element = 
    document.getElementById(id).style.display = "none";
    // <?php $_SESSION["msg_alert"] = ""; ?>
    // element.parentNode.removeChild(element);
}