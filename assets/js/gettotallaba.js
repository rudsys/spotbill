var totalLaba = <? php echo $total_laba; ?>;

// Format nilai total_laba menjadi format mata uang Indonesia tanpa angka desimal
var formattedTotalLaba = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
}).format(totalLaba);

// Perbarui elemen HTML dengan nilai total_laba yang sudah diformat
document.getElementById("totalLaba").innerHTML = formattedTotalLaba;