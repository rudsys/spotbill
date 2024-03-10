var selectedVoucher = <?php echo json_encode($list_vouchers); ?>;

    function checkProfileAndRedirect(voucherId) {
        var profile = '';

        for (var i = 0; i < selectedVoucher.length; i++) {
            if (selectedVoucher[i].id == voucherId) {
                profile = selectedVoucher[i].nama_profile;
                break;
            }
        }

        if (profileNotExistsInMikroTik(profile, i)) {
            alert('User Profile Tidak Tersedia,\nTransaksi Gagal');
            console.log(profile);
        } else {
            window.location.href = 'createVoucher.php?id=' + voucherId;
        }
    }

    function profileNotExistsInMikroTik(profile, index) {
        // Implement your MikroTik profile check here
        // Modify the comparison logic as needed
        var mikroTikProfile = selectedVoucher[index].nama_profile.trim().toLowerCase();
        var inputProfile = profile.trim().toLowerCase();

        if (inputProfile === mikroTikProfile) {
            console.log(profile);
            return false; // Profil tersedia
        } else {
            return true; // Profil tidak tersedia
        }
    }