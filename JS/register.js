document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert('รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน');
        event.preventDefault();
    }
});