<html lang="en">
    <h2>Email Verification Mail</h2>
    <p>Dear {{ $user->first_name }}, thank you for registering for simple pms. Click the link below then proceed to login</p>
    <p><a href="{{ $url }}">Verify my Email</a></p>
    <p>Best regards,</p>
    <p>Simple PMS team.</p>
</html>
