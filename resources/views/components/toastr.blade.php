<div x-data="{ 
        toastrOptions: {
            closeButton: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
        }
    }" 
    x-init="() => {
        $wire.on('toastr', (event) => {
            toastr.options = toastrOptions;
            toastr[event.icon](event.message);
        });
    }">
</div>