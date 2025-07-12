document.addEventListener('DOMContentLoaded', () => {

    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');
    const formMessage = document.getElementById('form-message');

    // Handle Registration
    if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const response = await fetch('php/register.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            formMessage.textContent = result.message;
            if (result.success) {
                formMessage.style.color = 'green';
                setTimeout(() => window.location.href = 'login.html', 2000);
            } else {
                formMessage.style.color = 'red';
            }
        });
    }

    // Handle Login
    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const response = await fetch('php/login.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                window.location.href = 'index.html'; // Redirect to home on success
            } else {
                formMessage.textContent = result.message;
                formMessage.style.color = 'red';
            }
        });
    }
});

// Basic check to redirect if not logged in
if (window.location.pathname.includes('index.html')) {
    // This is a simplified check. A proper implementation would use a session check via PHP.
    // For now, we assume if they land on index, they should be logged in.
}```

---

### **Step 4: Admin and Creator Sections**

These sections are placeholders. Building a secure and functional file editor or SQL runner from scratch is a highly complex and security-sensitive task. The code below provides the basic structure.

**`admin/admin.html`**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="php/logs.php">View User Logs</a>
        <a href="php/backup.php">Backup Database</a>
        <!-- Add other admin links here -->
    </nav>
    <!-- Admin content goes here -->
</body>
</html>
