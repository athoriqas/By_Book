document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let email = document.getElementById('loginEmail').value;
    let password = document.getElementById('loginPassword').value;

    // Contoh sederhana autentikasi
    // Anda bisa mengganti ini dengan logika autentikasi sesuai kebutuhan
    if (email === 'user@example.com' && password === 'password') {
        // Simpan status login
        localStorage.setItem('loggedIn', true);
        // Tampilkan pesan atau navigasi setelah login berhasil
        alert('Login successful!');
        window.location.href = 'index.html'; // Ganti dengan halaman tujuan setelah login berhasil
    } else {
        alert('Login failed. Please check your credentials.');
    }
});
