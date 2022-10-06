<!DOCTYPE html>
<html lang="en">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>

<body>
<div class="container">

    <form method="post">

            <input type="password" name="password" id="password" />
            <i class="bi bi-eye-slash" id="togglePassword"></i>


    </form>
</div>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("bi-eye");
    });


</script>
</body>

</html>