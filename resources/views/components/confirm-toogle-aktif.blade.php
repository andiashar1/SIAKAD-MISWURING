<div 
    x-data="{ open: false }"
    x-show="open"
    @confirm-toogle-aktif.window="
        open = true;
        const get_id = event.detail.get_id;
        Swal.fire({
            title: 'Ubah Status!',
            text: 'Anda Yakin Mengubah Status?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.toggleActive(get_id).then(result => {
                    Swal.fire('Diperharui!', 'Data Anda berhasil diperbaharui.', 'success');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Dibatalkan', 'Data Anda tetap aman :)', 'error');
            }
            open = false; // Tutup dialog setelah menangani hasil
        });
    "
>
</div>