function updateTopupTable() {
    $.ajax({
        url: 'getstatusTopup.php', // Sesuaikan dengan file PHP yang akan memproses pembaruan tabel top-up
        method: 'GET',
        success: function (response) {
            // Update tabel dengan data yang diperbarui
            $('#topupTable tbody').html(response);
            // Memanggil fungsi untuk memperbarui total topup
            // updateTotalTopup();
        },
        error: function (error) {
            console.error('Error updating top-up table:', error);
        }
    });
}

// Fungsi untuk memperbarui total dan menjalankan setiap 5 detik
function autoRefresh() {
    updateTopupTable();
}
// Memanggil fungsi autoRefresh setiap 5 detik
setInterval(autoRefresh, 1500);

    // Update the card title to display the current month in Indonesian
    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var currentMonth = new Date().getMonth();
    document.querySelector('#topupTitle').textContent = 'TopUp Bulan ' + monthNames[currentMonth];

    $(document).ready(function(){
        $("#cariTabel").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });