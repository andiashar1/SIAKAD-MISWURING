<div 
    x-data="{ open: false }"
    x-show="open"
    @confirm-delete.window="
        open = true;
        const get_id = event.detail.get_id;
        Swal.fire({
            title: 'Hapus Data!',
            text: 'Anda Yakin Menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapus(get_id).then(result => {
                    Swal.fire('Terhapus!', 'Data Anda berhasil dihapus.', 'success');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Dibatalkan', 'Data Anda tetap aman :)', 'error');
            }
            open = false; // Tutup dialog setelah menangani hasil
        });
    "
>
</div>