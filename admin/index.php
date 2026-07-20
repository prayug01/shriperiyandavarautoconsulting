<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sri Periyandavar Auto Consulting | Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Syne:wght@800&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
  body { height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #0A192F; color: #333; }
  .login-container { background: #fff; padding: 40px; border-radius: 12px; width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
  .brand-logo { width: 50px; height: 50px; background-color: #00B4D8; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 24px; color: #0A192F; font-family: 'Syne', sans-serif; margin: 0 auto 15px auto; }
  .login-header { text-align: center; margin-bottom: 30px; }
  .login-header h2 { font-size: 22px; color: #0A192F; }
  .login-header p { font-size: 13px; color: #64748B; margin-top: 5px; }
  
  .form-group { margin-bottom: 20px; }
  .form-group label { display: block; font-size: 12px; font-weight: 700; color: #64748B; margin-bottom: 8px; text-transform: uppercase; }
  .form-group input { width: 100%; padding: 12px 15px; border: 1px solid #E2E8F0; border-radius: 6px; font-size: 15px; outline: none; transition: 0.2s; }
  .form-group input:focus { border-color: #00B4D8; box-shadow: 0 0 0 3px rgba(0,180,216,0.1); }
  
  .btn-login { width: 100%; background: #00B4D8; color: #fff; border: none; padding: 14px; font-size: 15px; font-weight: 700; border-radius: 6px; cursor: pointer; transition: 0.2s; }
  .btn-login:hover { background: #0096C7; }
  .error-msg { color: #DC2626; font-size: 13px; text-align: center; margin-bottom: 15px; font-weight: 600; display: none; }
</style>
</head>
<body>

  <div class="login-container">
    <div class="brand-logo">S</div>
    <div class="login-header">
      <h2>Admin Portal</h2>
      <p>Sign in to access the control center</p>
    </div>
    
    <div class="error-msg" id="error-msg">Invalid username or password.</div>

    <form id="login-form" onsubmit="handleLogin(event)">
      <div class="form-group">
        <label>Admin Username / Phone</label>
        <input type="text" id="username" required placeholder="e.g. admin">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" id="password" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn-login" id="btn-submit">Secure Login</button>
    </form>
  </div>

  <script>
    async function handleLogin(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-submit');
        const err = document.getElementById('error-msg');
        
        btn.innerText = "Authenticating...";
        btn.disabled = true;
        err.style.display = 'none';

        const payload = {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value
        };

        try {
            const res = await fetch('api.php?action=admin_login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await res.json();

            if (data.status === 'success') {
                window.location.href = 'admin.php';
            } else {
                err.innerText = data.message || "Invalid credentials.";
                err.style.display = 'block';
                btn.innerText = "Secure Login";
                btn.disabled = false;
            }
        } catch (error) {
            err.innerText = "Server connection failed.";
            err.style.display = 'block';
            btn.innerText = "Secure Login";
            btn.disabled = false;
        }
    }
  </script>
</body>
</html>