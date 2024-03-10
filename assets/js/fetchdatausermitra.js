function updateFetchData() {
    $.ajax({
        // url: 'fetch.php?user=<?=$username?>',
        url: 'fetch.php?user=<?=$user_id?>',
        method: 'GET',
        success: function (response) {
            console.log('Data updated:', response);

            // Ambil nilai Total Bytes dari respons
            var totalBytes = response['Total Bytes'];
            var limitBytesUser = response['Limit Bytes'];
            var UpTime = response['Uptime'];
            var limitBytesReseller = 5368709120;
            // var limitBytesReseller =  1073741824;
            

            // Hitung persentase penggunaan kuota
            var percentage = (totalBytes / limitBytesReseller) * 100;

            // Bulatkan persentase menjadi 2 digit setelah koma
            var roundedPercentage = percentage.toFixed(0);

            // Format nilai Total Bytes menggunakan formatBytes
            var formattedTotalBytes = formatBytes(totalBytes);
            var formattedLimitBytes = formatBytes(limitBytesReseller);

            // Menetapkan nilai ke 0 jika formattedTotalBytes adalah NaN
            formattedTotalBytes = isNaN(formattedTotalBytes) ? 0 : formattedTotalBytes;

            // Update nilai knob dengan formattedTotalBytes
            $('.kuota').val(formattedTotalBytes).trigger('change');
            $('#kuotaLabel').text(formattedTotalBytes);
            $('#uptimeLabel').text(UpTime);


            // Update teks Kuota FUP dan kelas warna berdasarkan persentase
            if (percentage > 89) {
                $('#limitBytesReseller').text('Terpakai ' + roundedPercentage + '% dari FUP ' + formattedLimitBytes);
                $('.info-box').removeClass('bg-gradient-warning').addClass('bg-gradient-danger');
            } else if (percentage > 50) {
                $('#limitBytesReseller').text('Terpakai ' + roundedPercentage + '% dari FUP ' + formattedLimitBytes);
                $('.info-box').removeClass('bg-gradient-info').addClass('bg-gradient-warning');
            } else {
                $('#limitBytesReseller').text('Terpakai ' + roundedPercentage + '% dari FUP ' + formattedLimitBytes);
                $('.info-box').removeClass('bg-gradient-warning bg-gradient-danger').addClass('bg-gradient-info');
            }

            // Update width pada elemen dengan class "progress-bar"
            $('.progress-bar').css('width', percentage + '%');
        },
        error: function (error) {
            console.error('Error updating data:', error);
        }
    });
}

// Panggil fungsi updateFetchData setiap 30 detik
setInterval(updateFetchData, 10000);