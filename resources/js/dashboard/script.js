new DataTable("#data-table");

document.addEventListener("trix-file-accept", function (e) {
    e.preventDefault;
});

const swall = $(".flash-data").data("swall");
if (swall) {
    Swal.fire({
        title: "Success",
        text: swall,
        icon: "success",
    });
}
const error = $(".flash-data").data("error");
if (error) {
    Swal.fire({
        title: "Woops",
        text: error,
        icon: "error",
    });
}

$(".show-confirm").click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-2 tombol-confirm",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: "Yakin ingin dihapus?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
});
