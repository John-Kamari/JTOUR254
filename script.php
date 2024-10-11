 <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting

            // Collect form data
            const formData = new FormData(this);

            // Send registration request to server
            fetch('register_script.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Registration successful, log the user in
                    fetch('login_script.php', {
                        method: 'POST',
                        body: JSON.stringify({
                            email: formData.get('email'),
                            password: formData.get('password')
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = 'dashboard.html'; // Redirect to user dashboard
                        } else {
                            alert('Login failed. Please try again.');
                        }
                    });
                } else {
                    alert('Registration failed. Please try again.');
                }
            });
        });
    </script>