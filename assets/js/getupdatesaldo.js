function updateSaldo() {
    $.ajax({
        url: 'getSaldo.php',
        method: 'GET',
        success: function (response) {
            var saldoElement = document.getElementById('saldo');
            var topupBtnElement = document.getElementById('topupBtn');

            if (saldoElement) {
                saldoElement.innerHTML = 'Rp ' + response;

                // Tampilkan tombol top-up jika saldo kurang dari atau sama dengan 25000
                if (topupBtnElement) {
                    topupBtnElement.style.display = (parseInt(response.replace(/\D/g, '')) <= 50000) ? 'block' : 'none';
                } else {
                    console.error('Elemen dengan ID topupBtn tidak ditemukan.');
                }
            } else {
                console.error('Elemen dengan ID saldo tidak ditemukan.');
            }
        },
        error: function (error) {
            console.error('Error updating saldo:', error);
        }
    });
}


// Jalankan skrip setelah dokumen sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', function () {
    setInterval(updateSaldo, 1500); // Update setiap 1.5 detik
});