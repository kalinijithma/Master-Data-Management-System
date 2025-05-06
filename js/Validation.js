function check_form() {
    let isValid = true;

    // Clear previous messages
    document.getElementById("fname_msg").textContent = "";
    document.getElementById("email_msg").textContent = "";
    document.getElementById("pwd1_msg").textContent = "";
    document.getElementById("pwd2_msg").textContent = "";

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const pwd1 = document.getElementById("password1").value;
    const pwd2 = document.getElementById("password2").value;

    // Name check
    if (name === "") {
        document.getElementById("fname_msg").textContent = "Name is required";
        isValid = false;
    }

    // Email check
    if (email === "") {
        document.getElementById("email_msg").textContent = "Email is required";
        isValid = false;
    } else if (!email.includes("@")) {
        document.getElementById("email_msg").textContent = "Invalid email format";
        isValid = false;
    }

    // Password check
    if (pwd1.length < 6) {
        document.getElementById("pwd1_msg").textContent = "Password must be at least 6 characters";
        isValid = false;
    }

    if (pwd1 !== pwd2) {
        document.getElementById("pwd2_msg").textContent = "Passwords do not match";
        isValid = false;
    }


    return isValid;
}
